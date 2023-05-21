
.PHONY: lint test

test:
	XDEBUG_MODE=off ./vendor/bin/phpunit --coverage-html ./build/coverage --coverage-clover ./build/clover.xml --log-junit ./build/testreport.xml
	./vendor/bin/coverage-check build/clover.xml 100
lint:
	./vendor/bin/php-cs-fixer fix --diff
	./vendor/bin/phpstan analyse src tests
	./bin/console lint:container
	./bin/console lint:yaml ./config ./translations
	./bin/console lint:twig templates
	./bin/console debug:translation fr --only-missing
	./bin/console debug:translation en --only-missing
