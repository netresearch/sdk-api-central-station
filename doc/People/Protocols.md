# Protocols API
The protocol endpoint provides methods to e.g. attach notes to people, change existing notes or delete them. Notes
are also required to upload file attachments to the CRM. The endpoint can be accessed through the `protocols()`
method. In order to limit the query to a single protocol, the ID of the protocol must be passed as a parameter
to this method.

By default, the following actions are available for protocols:
- index()
    - Returns a list of all protocols in an account.
- show()
    - Returns a single protocol. Requires a valid protocol ID.
- [create()](#create-protocol)
    - Creates a new protocol.
- update()
    - Updates an existing protocol.
- delete()
    - Deletes an existing protocol.


In addition to the methods for protocols listed above, this endpoint also provides additional methods for
protocol-dependent queries.

- [attachments()](Protocols/Attachments.md)
    - Returns the attachments API endpoint used to process attachments related to a specific protocol. Pass the
      protocol ID as a parameter to the `protocols()`-method.


## <a name="create-protocol"></a>Create a new protocol
Creating a new note and assigning it to an existing person.

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\People\Protocols\CreateRequestBuilder();
$requestBuilder->setName('New note')
    ->setContent('New note content')
    ->setFormat(\Netresearch\Sdk\CentralStation\Constants::PROTOCOL_FORMAT_PLAINTEXT)
    ->setBadge(Netresearch\Sdk\CentralStation\Constants::PROTOCOL_BADGE_NOTE)
    ->setConfidential(false);

// Create a new protocol
$protocol = $apiClient
    ->api()
    ->people(<PERSON-ID>)
    ->protocols()
    ->create($requestBuilder->create());

// Do something with the response
```
