phpstan:
	vendor/bin/phpstan analyse --configuration phpstan.neon --level 7 src/

behat:
	vendor/bin/behat

phpunit:
	vendor/bin/phpunit

tests: phpstan phpunit behat

fix:
	vendor/bin/php-cs-fixer fix --verbose src/

