test: mappings phpcs phpstan phpunit behat

mappings:
	bin/console doctrine:schema:validate --skip-sync

phpcs:
	vendor/bin/php-cs-fixer fix --dry-run --verbose --allow-risky=yes src/

phpstan:
	vendor/bin/phpstan analyse --configuration=phpstan.neon --level=7 src/

phpunit:
	vendor/bin/phpunit

behat:
	vendor/bin/behat

fix:
	vendor/bin/php-cs-fixer fix --verbose --allow-risky=yes src/

db-reset: db-drop db-create db-schema

db-drop:
	bin/console doctrine:database:drop --force

db-create:
	bin/console doctrine:database:create

db-schema:
	bin/console doctrine:schema:create

fixtures: db-reset
	bin/console doctrine:fixtures:load --no-interaction
