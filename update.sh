#!/usr/bin/env bash
set -Eeuo pipefail

# https://raw.githubusercontent.com/docker-library/php/master/update.sh

declare -A gpgKeys=(
	[7.3]='CBAF69F173A0FEA4B537F470D66C9593118BCCB6 F38252826ACD957EF380D39F2F7956BC5DA04B5D'
	[7.2]='1729F83938DA44E27BA0F4D3DBDB397470D12172 B1B44D8F021E4E2D6021E995DC9FF8D3EE5AF27F'
	[7.1]='A917B1ECDA84AEC2B568FED6F50ABC807BD5DCD0 528995BFEDFBA7191D46839EF9BA0ADA31CBD89E 1729F83938DA44E27BA0F4D3DBDB397470D12172'
)

cd "$(dirname "$(readlink -f "$BASH_SOURCE")")"

versions=( "$@" )
if [ ${#versions[@]} -eq 0 ]; then
	versions=( */ )
fi
versions=( "${versions[@]%/}" )

generated_warning() {
	cat <<-EOH
		#
		# NOTE: THIS DOCKERFILE IS GENERATED VIA "update.sh"
		#
		# PLEASE DO NOT EDIT IT DIRECTLY.
		#

	EOH
}

travisEnv=
dockerfiles=()
readmeList=()
for version in "${versions[@]}"; do
	rcVersion="${version%-rc}"

	majorVersion="${rcVersion%%.*}"
	minorVersion="${rcVersion#$majorVersion.}"
	minorVersion="${minorVersion%%.*}"

	apiUrl="https://secure.php.net/releases/index.php?json&max=100&version=${rcVersion%%.*}"
	apiJqExpr='
		(keys[] | select(startswith("'"$rcVersion"'."))) as $version
		| [ $version, (
			.[$version].source[]
			| select(.filename | endswith(".xz"))
			|
				"https://secure.php.net/get/" + .filename + "/from/this/mirror",
				"https://secure.php.net/get/" + .filename + ".asc/from/this/mirror",
				.sha256 // "",
				.md5 // ""
		) ]
	'
	if [ "$rcVersion" != "$version" ]; then
		apiUrl='https://qa.php.net/api.php?type=qa-releases&format=json'
		apiJqExpr='
			.releases[]
			| select(.version | startswith("'"$rcVersion"'."))
			| [
				.version,
				.files.xz.path // "",
				"",
				.files.xz.sha256 // "",
				.files.xz.md5 // ""
			]
		'
	fi
	IFS=$'\n'
	possibles=( $(
		curl -fsSL "$apiUrl" \
			| jq --raw-output "$apiJqExpr | @sh" \
			| sort -rV
	) )
	unset IFS

	if [ "${#possibles[@]}" -eq 0 ]; then
		echo >&2
		echo >&2 "error: unable to determine available releases of $version"
		echo >&2
		exit 1
	fi

	eval "possi=( ${possibles[0]} )"
	fullVersion="${possi[0]}"
	url="${possi[1]}"
	ascUrl="${possi[2]}"
	sha256="${possi[3]}"
	md5="${possi[4]}"

	gpgKey="${gpgKeys[$rcVersion]}"
	if [ -z "$gpgKey" ]; then
		echo >&2 "ERROR: missing GPG key fingerprint for $version"
		echo >&2 "  try looking on https://secure.php.net/downloads.php#gpg-$version"
		exit 1
	fi

	for suite in stretch jessie alpine{3.9,3.8}; do
		[ -d "$version/$suite" ] || continue

		baseDockerfile=Dockerfile-debian.template
		baseEntrypointfile=entrypoint-debian
		if [ "${suite#alpine}" != "$suite" ]; then
			baseDockerfile=Dockerfile-alpine.template
			baseEntrypointfile=entrypoint-alpine
		fi

		for variant in cli apache fpm zts; do
			[ -d "$version/$suite/$variant" ] || continue
			{ generated_warning; cat "$baseDockerfile"; } > "$version/$suite/$variant/Dockerfile"

			echo "Generating $version/$suite/$variant/Dockerfile from $baseDockerfile"

			imageTag="$fullVersion-$variant-$suite"

			cp "$baseDockerfile" "$version/$suite/$variant/Dockerfile"
            cp "$baseEntrypointfile" "$version/$suite/$variant/entrypoint"

            sed -i "s/%%IMAGE_TAG%%/$imageTag/g" "$version/$suite/$variant/Dockerfile"
            sed -i -e '/%%SYMFONY%%/{r symfony.template' -e 'd}' "$version/$suite/$variant/Dockerfile"

            if [ 'jessie' = "$suite" ]; then
                sed -i '/libzip4/d' "$version/$suite/$variant/Dockerfile"
            fi

            if [ 'apache' = "$variant" ]; then
                sed -i -e '/%%APACHE%%/{r apache.template' -e 'd}' "$version/$suite/$variant/Dockerfile"
            else
                sed -i 's/%%APACHE%%//g' "$version/$suite/$variant/Dockerfile"
            fi

			awk '
				NF > 0 { blank = 0 }
				NF == 0 { ++blank }
				blank < 2 { print }
			' "$version/$suite/$variant/Dockerfile" > "$version/$suite/$variant/Dockerfile.new"
			mv "$version/$suite/$variant/Dockerfile.new" "$version/$suite/$variant/Dockerfile"

            readme="$imageTag"
			dockerfiles+=( "$version/$suite/$variant/Dockerfile" )
			travisEnv+="\n  - FOLDER=$version/$suite/$variant/ TAGS=$imageTag"

            if [ 'alpine3.9' = "$suite" ]; then
                travisEnv+=",$majorVersion.$minorVersion-$variant"
                readme+=", $majorVersion.$minorVersion-$variant"
                if [ 'cli' = "$variant" ]; then
                    travisEnv+=",$fullVersion,$majorVersion.$minorVersion"
                    readme+=", $fullVersion, $majorVersion.$minorVersion"
                fi
            fi

            readme+=" ([$version/$suite/$variant/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/$version/$suite/$variant/Dockerfile))"
            readmeList=("$readme" "${readmeList[@]}")

		done
	done
done

sed -i "s/%%APCU_VERSION%%/5.1.17/g" "${dockerfiles[@]}"

travis=$(awk -v tags="env:$travisEnv" -v 'RS=\n\n' '$1 == "env:" { $0 = tags } { printf "%s%s", $0, RS }' .travis.yml)
echo "$travis" > .travis.yml

readme=$(printf "\n- %s" "${readmeList[@]}")
readme=$(awk -v tags=" Tags\n$readme\n\n" -v 'FS=\n\n' -v 'title=' -v 'RS=##' '$1 == " Tags" { $0 = tags; title=RS } { printf "%s%s", title, $0 }' README.md)
echo "$readme" > README.md
