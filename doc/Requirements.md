# Requirements

## System Requirements
- PHP 7.3+ with JSON extension


# Installation
In order to install this package your set-up requires already installed packages implementing
`psr/http-client-implementation` and `psr/http-factory-implementation`, for instance `php-http/guzzle6-adapter`
and `nyholm/psr7`.

```bash
composer require netresearch/sdk-api-central-station
```


# Uninstallation
```bash
composer remove netresearch/sdk-api-central-station
```


# Testing
```bash
composer update
vendor/bin/phpcs src/ --standard=PSR12
vendor/bin/phpunit
vendor/bin/phpstan analyse -c phpstan.neon
```
