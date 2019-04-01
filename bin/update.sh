#!/usr/bin/env bash
set -Eeuo pipefail

travisEnv=
for php in 7.{1,2,3}; do
    for os in stretch jessie alpine3.{8,9}; do
        [[ $os = stretch || $os = jessie ]] && folder=debian || folder=alpine
		for exec in cli apache fpm zts; do
            if [[ $folder = "alpine" && $exec = "apache" ]] || [[ $php = 7.2 && $os = jessie ]] || [[ $php = 7.3 && $os = jessie ]] ; then
                continue
            fi
		    travisEnv+='\n  - PHP='"$php OS=$os E=$exec F=$folder"
        done
    done
done

travis="$(awk -v 'RS=\n\n' '$1 == "env:" { $0 = "env:'"$travisEnv"'" } { printf "%s%s", $0, RS }' .travis.yml)"
echo "$travis" > .travis.yml
