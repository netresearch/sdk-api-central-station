# Custom fields API
The custom fields API endpoint can be accessed through the `customFields()` method. In order to limit the query 
to a single custom field, the ID of the custom field must be passed as a parameter to this method.

By default, the following actions are available for custom fields:
- index()
    - Returns a list of all custom fields.
- show()
    - Returns a single custom field. Requires a valid custom field ID.
- create()
    - Creates a new custom field.
- update()
    - Updates an existing custom field.
- delete()
    - Deletes an existing custom field.
