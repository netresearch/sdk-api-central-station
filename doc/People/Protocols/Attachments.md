# Attachments API
The attachment endpoint provides methods to access attachments assigned to notes (protocols), or to create new 
attachments or remove existing ones. The endpoint can be accessed through the `attachments()` method. In order to
limit the query to a single attachment, the ID of the attachment must be passed as a parameter to this method.

By default, the following actions are available for attachments:
- index()
    - Returns a list of all attachments assigned to a protocol.
- show()
    - Returns a single attachment assigned to a protocol. Requires a valid attachment ID.
- [create()](#create-attachment)
    - Creates a new attachment at the protocol.
- delete()
    - Deletes an existing attachment at a protocol.


## <a name="create-attachment"></a>Create a new attachment
Creating a new file attachment and assigning it to an existing note.

```php
// Create request builder instance
$requestBuilder = new \Netresearch\Sdk\CentralStation\RequestBuilder\Protocols\Attachments\CreateRequestBuilder();
$requestBuilder->setFilename('filename.jpg')
    ->setContentType('image/jpg')
    ->setData(<BASE64-ENCODED-FILE-CONTENT>);

// Create a new attachment
$attachment = $apiClient
    ->api()
    ->protocols(<PROTOCOL-ID>)
    ->attachments()
    ->create($requestBuilder->create());

// Do something with the response
```
