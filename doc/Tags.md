# Tags API
The tag endpoint provides methods, for example, to attach a label to people or companies, which they can use to
group, search, or sort them afterwards. The endpoint can be accessed through the `tags()` method. In order to
limit the query to a single tag, the ID of the tag must be passed as a parameter to this method.

By default, the following actions are available for tags:
- [index()](#index)
    - Returns a list of all tags in an account.
- show()
    - Returns a single tag. Requires a valid tag ID for the account.
- list()
    - Returns a list of all tag names in the account.


## <a name="index"></a>Get a list of all tags in the account

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\Tags\IndexRequestBuilder();
$requestBuilder
    ->setLimit(10)
    ->setOrder(
        'name',
        \Netresearch\Sdk\CentralStation\Constants::ORDER_DIRECTION_ASC
    );

// Perform request, returns a collection of tags in the account sorted by name in ascending order
$tagsCollection = $apiClient
    ->api()
    ->tags()
    ->index($requestBuilder->create());

// Do something with the response
/** @var \Netresearch\Sdk\CentralStation\Model\Tags $tags */
foreach ($tagsCollection as $tags) {
    echo $tags->tag->id . ' ' . $tags->tag->name;

    // ...
}
```
