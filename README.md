[![pipeline status](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/badges/master/pipeline.svg)](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/-/commits/master)
[![coverage report](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/badges/master/coverage.svg)](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/-/commits/master)

# Central Station API
The documentation for all request can be found at <https://42he.com/de/developer/crm>.

The Central Station API SDK package offers an interface to the *Central Station* interface.
The SDK implements only the currently required endpoints and data structures.


## Requirements

### System Requirements
- PHP 7.3+ with JSON extension


## Installation
```bash
composer require netresearch/sdk-api-central-station
```


## Uninstallation
```bash
composer remove netresearch/sdk-api-central-station
```


## Testing
```bash
composer update
vendor/bin/phpcs src/ --standard=PSR12
vendor/bin/phpunit
vendor/bin/phpstan analyse -c phpstan.neon
```


## Usage
Use one of the provided request builders to create a valid request structure.


## Error handling
The exceptions thrown by the SDK will always be of type `\Netresearch\Sdk\CentralStation\Exception\ServiceException`.
Subclasses of `ServiceException` may be used to describe the kind of error that occurred.

A `\Netresearch\Sdk\CentralStation\Exception\DetailedServiceException` indicates that the exception holds a
human-readable error message suitable for display to the end-user.
