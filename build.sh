#!/usr/bin/env bash

set -e
set -o pipefail

pushd $(dirname $0) 1> /dev/null
EARTHLY='./build/bin/earthly'
mkdir -p $(dirname $EARTHLY)

if [ ! -e $EARTHLY ] && [ $(uname) = "Darwin" ]
then
    curl -L https://github.com/earthly/earthly/releases/download/v0.7.0/earthly-darwin-amd64 -o $EARTHLY
fi

if [ ! -e $EARTHLY ] && [ $(uname) = "Linux" ]
then
    curl -L https://github.com/earthly/earthly/releases/download/v0.7.0/earthly-linux-amd64 -o $EARTHLY
fi

if [ ! -f "$EARTHLY" ]; then
    echo "Your system may not be supported"
    popd
    exit 1
fi

chmod +x $EARTHLY

TIMESTAMP=$(date +%s)

export FORCE_COLOR=1
$EARTHLY bootstrap
$EARTHLY --allow-privileged --verbose $@ 2>&1 | tee ./build/$TIMESTAMP.log
echo "Log written in ./build/$TIMESTAMP.log"
popd 1> /dev/null
