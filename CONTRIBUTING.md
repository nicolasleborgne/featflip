# Contributing

## Development environment

Requirements :

- devbox
- docker

Entering shell providing binaries (php etc ...)

```shell
devbox shell
```

Starting infrastructure

```shell
docker compose up -d
```

Run linting

```
make lint
```

Run tests

```
make test
```

## Build

Build is handled by Earthly in order to reduce gape with github actions. This means that you can run :

```shell
# Run lint
./build.sh '+lint'
# Run tests
./build.sh '+test'
# Build docs
./build.sh '+docs'
# All
./build.sh '+all'
```
It will be run in the same isolated environment as github actions.

The environment is based on docker nicilbrgn/php:8.1. Dockerfile is `Dockerfile.ci`, rebuild it with :

```shell
./build-ci-image.sh
```

## Commit message

```
<type>: <description>
```

Type can be :

- feat
- fix
- test
- style
- ci
- docs
- perf
- refactor

