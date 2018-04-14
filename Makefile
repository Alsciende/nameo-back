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
