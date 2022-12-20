# Addresses API
The addresses API endpoint can be accessed through the `addresses()` method. In order to limit the query to a single
address, the ID of the address must be passed as a parameter to this method.

By default, the following actions are available for addresses:
- index()
    - Returns a list of all addresses.
- show()
    - Returns a single address. Requires a valid address ID.
- create()
    - Creates a new address.
- update()
    - Updates an existing address.
- delete()
    - Deletes an existing address.
