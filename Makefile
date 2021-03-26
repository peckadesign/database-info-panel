composer:
	composer validate
	composer update --no-interaction --prefer-dist

phpstan:
	vendor/bin/phpstan analyse src/ --level 8 --no-progress --error-format github
