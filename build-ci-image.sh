#!/bin/bash

set -e

export DOCKER_BUILDKIT=1

IMAGE=nicolbrgn/php
TAG=8.2
PUSH_ARGS='--push'

if [ "$1" == "--no-push" ]
then
  PUSH_ARGS=''
fi

docker buildx build --file Dockerfile.ci \
                    --ssh default \
                    --platform linux/amd64,linux/arm64 \
                    --tag $IMAGE:$TAG \
                    --pull $PUSH_ARGS .
