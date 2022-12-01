[![pipeline status](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/badges/master/pipeline.svg)](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/-/commits/master)
[![coverage report](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/badges/master/coverage.svg)](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/-/commits/master)
[![Latest Release](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/-/badges/release.svg)](https://git.netresearch.de/futuresax/lib/sdk-api-central-station/-/releases)

# Central Station API
The documentation for all request can be found at <https://42he.com/de/developer/crm>.

The Central Station API SDK package offers an interface to the *Central Station* interface.
The SDK implements only the currently required endpoints and data structures.


## Requirements

### System Requirements
- PHP 7.3+ with JSON extension


## Installation
In order to install this package your set-up requires already installed packages implementing
`psr/http-client-implementation` and `psr/http-factory-implementation`, for instance `php-http/guzzle6-adapter`
and `nyholm/psr7`.

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
Use one of the provided request builders to create a valid request structure. This allows using the SDK without
having to know the underlying API.


### Rate limit
Use of the API is limited to 50 requests within 10 seconds. For requests that are above this limit, the API 
can respond with the HTTP response code 429 (Too Many Requests). The Retry-After header is then set.


### Create an API instance
Create a new API instance, providing a valid API URL and API key.

```php
// Create API instance
$apiClient = new \Netresearch\Sdk\CentralStation\CentralStation(
    new \Psr\Log\NullLogger(),
    '<API-BASE-URL>',
    '<API-KEY>'
);
```


#### People API

##### Get a list of persons

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\People\IndexRequestBuilder();
$requestBuilder
    ->setLimit(10)
    ->setOrder(
        'name',
        \Netresearch\Sdk\CentralStation\Constants::ORDER_DIRECTION_ASC
    )
    ->addFilter(
        'name',
        \Netresearch\Sdk\CentralStation\Constants::FILTER_EQUAL,
        'Mustermann'
    )
    ->addFilter(
        'created_at',
        \Netresearch\Sdk\CentralStation\Constants::FILTER_SMALLER_THAN,
        '2022-10-25'
    )
    ->addInclude(\Netresearch\Sdk\CentralStation\Constants::INCLUDE_TAGS)
    ->addInclude(\Netresearch\Sdk\CentralStation\Constants::INCLUDE_ADDRESSES);

// Perform request, returns a collection of people matching the filters and including additional data
$peopleCollection = $apiClient
    ->api()
    ->people()
    ->index($requestBuilder->create());

// Do something with the response
/** @var \Netresearch\Sdk\CentralStation\Model\People $people */
foreach ($peopleCollection as $people) {
    echo $people->person->firstName . ' ' . $people->person->name;

    // ...
}
```


##### Create a new person

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\People\CreateRequestBuilder();
$requestBuilder
    ->setPerson(
        'Mustermann',
        'Max',
        \Netresearch\Sdk\CentralStation\Constants::GENDER_MALE,
        'Dr. Dr.'
    );

// Perform request, returns instance of the newly created person
$person = $apiClient
    ->api()
    ->people()
    ->create($requestBuilder->create());

// Do something with the response
```


##### Update an existing person

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\People\UpdateRequestBuilder();
$requestBuilder
    ->setPerson(
        'Musterfrau',
        'Maxi',
        \Netresearch\Sdk\CentralStation\Constants::GENDER_FEMALE
    );

// Perform request, returns TRUE if request was successful
$response = $apiClient
    ->api()
    ->people(123456)
    ->update($requestBuilder->create());

// Do something with the response
```


#### Tags API

##### Get a list of tags assigned to a specific person

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\Tags\IndexRequestBuilder();
$requestBuilder
    ->setLimit(10)
    ->setOrder(
        'name',
        \Netresearch\Sdk\CentralStation\Constants::ORDER_DIRECTION_ASC
    );

// Perform request, returns a collection of tags for person ID 123456
$tagsCollection = $apiClient
    ->api()
    ->people(123456)
    ->tags()
    ->index($requestBuilder->create());

// Do something with the response
/** @var \Netresearch\Sdk\CentralStation\Model\Tags $tags */
foreach ($tagsCollection as $tags) {
    echo $tags->tag->id . ' ' . $tags->tag->name;

    // ...
}
```

## Error handling
The exceptions thrown by the SDK will always be of type `\Netresearch\Sdk\CentralStation\Exception\ServiceException`.
Subclasses of `ServiceException` may be used to describe the kind of error that occurred.

A `\Netresearch\Sdk\CentralStation\Exception\DetailedServiceException` indicates that the exception holds a
human-readable error message suitable for display to the end-user.

Surround each API call with a try/catch block to do a proper exception handling.

```php
try {
    // Create request builder instance
    $requestBuilder = ...

    // Perform request
    $response = $apiClient
        ->api()
        -> ...

    // ...
} catch (\Netresearch\Sdk\CentralStation\Exception\ServiceException $exception) {
    // Handle errors
}
```
