# People API
By default, the following actions are available for people and other objects in the CentralStation CRM:
index, show, create, update and delete.

The people API endpoint can be accessed through the `people()` method. In order to limit the query to a single
person, the ID of the person must be passed as a parameter to this method.

```php
$response = $apiClient
    ->api()
    ->people(<PERSON-ID>)
    ->...
```

The following methods are available to interact with the endpoint:

- [index()](#index)
    - Returns a list of all people in an account.
- show()
    - Returns a single person. Requires a valid person ID.
- [create()](#create-person)
    - Creates a new person.
- [update()](#update-person)
    - Updates an existing person.
- delete()
    - Deletes an existing person.
- [search()](#search-people)
    - Searches for one or more people.
- merge()
    - Merge one or more people with an existing person.
- stats()
    - Returns the total number of people for all or filtered persons.

In addition to the methods for people listed above, this endpoint also provides additional methods for 
person-dependent queries, e.g. addresses, tags and notes (protocols).

- [tags()](People/Tags.md)
    - Returns the tags API endpoint used to process tags related to a specific person. Pass the
      person ID as a parameter to the `people()`-method.

- [addresses()](People/Addresses.md)
    - Returns the addresses API endpoint used to process addresses related to a specific person. Pass the
      person ID as a parameter to the `people()`-method.

- [protocols()](People/Protocols.md)
    - Returns the protocols API endpoint used to process protocols (notes) related to a specific person. Pass the
      person ID as a parameter to the `people()`-method.


## <a name="index"></a>Get a list of persons
Query all people named "Doe" whose record was created before 10/25/2022. In addition, the result should be limited
to a maximum of 10 records and sorted by name in ascending order. Furthermore, the additional information for
tags and addresses should be included in the response.

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
        'Doe'
    )
    ->addFilter(
        'created_at',
        \Netresearch\Sdk\CentralStation\Constants::FILTER_SMALLER_THAN,
        '2022-10-25'
    )
    ->addInclude(\Netresearch\Sdk\CentralStation\Constants::INCLUDE_TAGS)
    ->addInclude(\Netresearch\Sdk\CentralStation\Constants::INCLUDE_ADDRESSES);

// Perform request, returns a collection of people
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


## <a name="index"></a>Get a list of persons with tag
Query all people who are linked to the tag "MY-TAG".

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\People\IndexRequestBuilder();
$requestBuilder
    ->setTagRestriction(null, 'MY-TAG');

// Perform request, returns a collection of people
$peopleCollection = $apiClient
    ->api()
    ->people()
    ->index($requestBuilder->create());

// ...
```


## <a name="create-person"></a>Create
Create a new male named John Doe.

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\People\CreateRequestBuilder();
$requestBuilder
    ->setPerson(
        'Doe',
        'John',
        \Netresearch\Sdk\CentralStation\Constants::GENDER_MALE,
        'Dr.'
    );

// Perform request, returns instance of the newly created person
$person = $apiClient
    ->api()
    ->people()
    ->create($requestBuilder->create());

// Do something with the response
```


## <a name="update-person"></a>Update
Updating an existing person.

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\People\UpdateRequestBuilder();
$requestBuilder
    ->setPerson(
        'Doe',
        'Jane',
        \Netresearch\Sdk\CentralStation\Constants::GENDER_FEMALE
    );

// Perform request, returns TRUE if request was successful
$response = $apiClient
    ->api()
    ->people(<PERSON-ID-TO-UPDATE>)
    ->update($requestBuilder->create());

// Do something with the response
```


## <a name="search-people"></a>Search
Find all people with the email address "john.doe@example.org". Additionally add the address information for each
hit to the result and limit the number to 10 hits.

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\People\SearchRequestBuilder();
$requestBuilder
    ->setLimit(10)
    ->addQuery(
        \Netresearch\Sdk\CentralStation\Constants::SORT_BY_EMAIL,
        'john.doe@example.org'
    )
    ->addInclude(\Netresearch\Sdk\CentralStation\Constants::INCLUDE_ADDRESSES);

// Perform request, returns a collection of people
$peopleCollection = $apiClient
    ->api()
    ->people()
    ->search($requestBuilder->create());

// Do something with the response
```
