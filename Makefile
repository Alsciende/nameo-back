phpcs:
	vendor/bin/php-cs-fixer fix --dry-run --allow-risky=yes src/

phpstan:
	vendor/bin/phpstan analyse --configuration=phpstan.neon --level=7 src/

phpunit:
	vendor/bin/phpunit

behat:
	vendor/bin/behat

test: phpcs phpstan phpunit behat

fix:
	vendor/bin/php-cs-fixer fix --verbose --allow-risky=yes src/

db-drop:
	bin/console doctrine:database:drop --force

db-create:
	bin/console doctrine:database:create

db-recreate: db-drop db-create

fixtures:
	bin/console doctrine:fixtures:load
