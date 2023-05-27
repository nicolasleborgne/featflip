VERSION 0.7
FROM nicolbrgn/php:8.1
WORKDIR /code

deps:
    ENV XDG_CACHE_HOME=/code/build/cache
    COPY --dir --if-exists ./build/cache /code/build/cache
    COPY composer.* .
    RUN composer install --no-scripts
    COPY --dir . .
    SAVE ARTIFACT ./build/cache AS LOCAL ./build/cache

lint:
    FROM +deps
    RUN make lint

test:
    FROM +deps
    WITH DOCKER --compose docker-compose.yml \
                --service postgres
        RUN while ! pg_isready --host=localhost --port=5432 --dbname=app --username=app; do sleep 1; done ;\
        make test
    END
    SAVE ARTIFACT ./build/coverage AS LOCAL ./build/coverage
    SAVE ARTIFACT ./build/testreport.xml AS LOCAL ./build/testreport.xml

docs:
    COPY --dir --if-exists .tox .
    COPY tox.ini .
    COPY mkdocs.yml .
    COPY --dir docs .
    RUN tox -e mkdocs
    SAVE ARTIFACT .tox AS LOCAL .tox
    SAVE ARTIFACT ./build/docs AS LOCAL ./build/docs
all:
    BUILD +deps
    BUILD +lint
    BUILD +test
    BUILD +docs
