# Tags API
The tag endpoint provides methods, for example, to attach a label to a person. It can be accessed through
the `tags()` method. In order to limit the query to a single tag, the ID of the tag must be passed as a
parameter to this method.

By default, the following actions are available for tags:
- index()
    - Returns a list of all tags assigned to a person.
- show()
    - Returns a single tag assigned to a person. Pass the tag ID as a parameter to the `tags()`-method.
- [create()](#create-tag)
    - Creates a new tag at the person.
- update()
    - Updates an existing tag at a person. Pass the tag ID as a parameter to the `tags()`-method.
- delete()
    - Deletes an existing tag at a person. Pass the tag ID as a parameter to the `tags()`-method.


## <a name="create-tag"></a>Create a new tag at a person

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\People\Tags\CreateRequestBuilder();
$requestBuilder->setTagName('NEW-FANCY-TAG');

// Create a new tag at person
$tag = $apiClient
    ->api()
    ->people(<PERSON-ID>)
    ->tags()
    ->create($requestBuilder->create());

// Do something with the response
```
