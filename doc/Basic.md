# Usage
The usage of the SDK is pretty straight forward. In order to perform a request use one of the provided request
builders to create a valid request object. This allows you the using of the SDK without having to know the 
underlying API. Use the request object together with the desired API endpoint method to call the interface.

## Create an API instance
But first of all you need to create a new API instance. You pass the API URL to be called and the API key 
to this instance.

```php
// Create API client instance
$apiClient = new \Netresearch\Sdk\CentralStation\CentralStation(
    new \Psr\Log\NullLogger(),
    '<API-BASE-URL>',
    '<API-KEY>'
);
```

The client instance provides one method `api()` to access the implemented API endpoints.  


## Class map
Optionally, an additional class map can be passed to the constructor of the API client as the fourth parameter.
By default, the JSON response from the API is mapped to the appropriate models in the SDK. By passing an alternative
mapping, the returned class structure can be adapted to the needs. The class to be overwritten in the SDK is
specified as the key, and the name of the new class is expected as the value.

```php
// Class map <source => target>
$classMap = [
    \Netresearch\Sdk\CentralStation\Model\Tags::class     => \Vendor\Model\Tags::class,
    \Netresearch\Sdk\CentralStation\Model\Tags\Tag::class => \Vendor\Model\Tag::class,
];

$apiClient = new \Netresearch\Sdk\CentralStation\CentralStation(
    new \Psr\Log\NullLogger(),
    '<API-BASE-URL>',
    '<API-KEY>',
    $classMap
);
```


# Limitations

## Rate limit
The use of the API is limited to 50 requests within 10 seconds. For requests that are above this limit, the API will 
respond with the HTTP response code 429 (Too Many Requests). The Retry-After header is then set.
