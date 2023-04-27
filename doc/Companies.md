# Companies API
By default, the following actions are available for companies and other objects in the CentralStation CRM:
index, show, create, update and delete.

The companies API endpoint can be accessed through the `companies()` method. In order to limit the query to a single
company, the ID of the company must be passed as a parameter to this method.

```php
$response = $apiClient
    ->api()
    ->companies(<COMPANY-ID>)
    ->...
```

The following methods are available to interact with the endpoint:

- [index()](#index)
    - Returns a list of all companies in an account.
- show()
    - Returns a single company. Requires a valid company ID.
- [create()](#create-company)
    - Creates a new company.
- [update()](#update-company)
    - Updates an existing company.
- delete()
    - Deletes an existing company.
- [search()](#search-companies)
    - Searches for one or more companies.
- stats()
    - Returns the total number of companies for all or filtered companies.

In addition to the methods for companies listed above, this endpoint also provides additional methods for 
company-dependent queries, e.g. addresses, tags and notes (protocols).

- [addresses()](Companies/Addresses.md)
    - Returns the addresses API endpoint used to process addresses related to a specific company. Pass the
      company ID as a parameter to the `companies()`-method.

- [customFields()](Companies/CustomFields.md)
    - Returns the custom fields API endpoint used to process custom fields related to a specific company. Pass the
      company ID as a parameter to the `companies()`-method.


## <a name="index"></a>Get a list of companies
Query all companies named "ABC" whose record was created before 10/25/2022. In addition, the result should be limited
to a maximum of 10 records and sorted by name in ascending order. Furthermore, the additional information for
tags and addresses should be included in the response.

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\Companies\IndexRequestBuilder();
$requestBuilder
    ->setLimit(10)
    ->setOrder(
        'name',
        \Netresearch\Sdk\CentralStation\Constants::ORDER_DIRECTION_ASC
    )
    ->addFilter(
        'name',
        \Netresearch\Sdk\CentralStation\Constants::FILTER_EQUAL,
        'ABC'
    )
    ->addFilter(
        'created_at',
        \Netresearch\Sdk\CentralStation\Constants::FILTER_SMALLER_THAN,
        '2022-10-25'
    )
    ->addInclude(\Netresearch\Sdk\CentralStation\Constants::INCLUDE_TAGS)
    ->addInclude(\Netresearch\Sdk\CentralStation\Constants::INCLUDE_ADDRESSES);

// Perform request, returns a collection of companies
$companiesCollection = $apiClient
    ->api()
    ->companies()
    ->index($requestBuilder->create());

// Do something with the response
/** @var \Netresearch\Sdk\CentralStation\Model\Companies $companies */
foreach ($companiesCollection as $companies) {
    echo $companies->company->name;

    // ...
}
```


## <a name="index"></a>Get a list of companies with tag
Query all companies who are linked to the tag "MY-TAG".

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\Companies\IndexRequestBuilder();
$requestBuilder
    ->setTagRestriction(null, 'MY-TAG');

// Perform request, returns a collection of companies
$companiesCollection = $apiClient
    ->api()
    ->companies()
    ->index($requestBuilder->create());

// ...
```


## <a name="create-company"></a>Create
Create a new company named "ABC company".

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\Companies\CreateRequestBuilder();
$requestBuilder
    ->setCompany('ABC company');

// Perform request, returns instance of the newly created company
$company = $apiClient
    ->api()
    ->companies()
    ->create($requestBuilder->create());

// Do something with the response
```


## <a name="update-company"></a>Update
Updating an existing company.

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\Companies\UpdateRequestBuilder();
$requestBuilder
    ->setCompany('DEF company');

// Perform request, returns TRUE if request was successful
$response = $apiClient
    ->api()
    ->companies(<COMPANY-ID-TO-UPDATE>)
    ->update($requestBuilder->create());

// Do something with the response
```


## <a name="search-companies"></a>Search
Find all companies with the email address "john.doe@example.org". Additionally add the address information for each
hit to the result and limit the number to 10 hits.

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\Companies\SearchRequestBuilder();
$requestBuilder
    ->setLimit(10)
    ->addQuery(
        \Netresearch\Sdk\CentralStation\Constants::SORT_BY_EMAIL,
        'john.doe@example.org'
    )
    ->addInclude(\Netresearch\Sdk\CentralStation\Constants::INCLUDE_ADDRESSES);

// Perform request, returns a collection of companies
$companiesCollection = $apiClient
    ->api()
    ->companies()
    ->search($requestBuilder->create());

// Do something with the response
```
