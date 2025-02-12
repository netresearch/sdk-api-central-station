# 1.0.1

## MISC

- 8d6e42a FX-509: Fix phpstan issue
- 77c0b6d FX-509: Update php version constraints and gitlab pipeline configuration
- 5e0fba7 FX-509: Use DateTime format constant
- 3f1a6cc FX-706: Add tags-endpoint to companies
- 9ee1a53 FX-706: Add custom fields filter to people and company index request
- e0a8d01 FX-509: Add companies API endpoint
- 8f3ff91 Update gitlab CI configuration

## Contributors

- Rico Sonntag

# 1.0.0

## MISC

- cc4c251 FX-531: Handling null value in country code
- f4b27a6 FX-529: Allow passing website information to CRM
- 1faa28c FX-528: Limit tag length
- 8e6a020 FX-531: Add possiblity to assign tags to person on update request
- 4398cb4 FX-585: Add nameClean to contact detials, used for telephone numbers
- 171aac0 FX-523: Add calendar event attendee structure
- aa9f5f3 FX-583: Fix phpstan issues
- baaa26e FX-583: Add methods to add attendees to calendar events
- f5a5c0d FX-583: Add group calendars endpoint
- bb4401d FX-583: Add cal_events endpoint
- eb77d3b FX-1: Rework class structure
- b6fb9aa FX-581: Add additional attributes to person element
- 9529150 FX-581: Add attributes to people endpoint
- a953c6d FX-512: Fix wording
- 808daa6 FX-512: Add custom fields to person and tests
- f59bd2e FX-512: Add more tests
- 74d4a1e FX-512: phpstan adjustments
- fea985a FX-512: Fix update/delete tests
- 58b8d5b FX-512: Add request tests
- e8ee4df FX-512: Add custom fields types API endpoint
- 2708569 FX-1: Fixed checking status code for update and delete requests
- bfd9ef8 FX-1: Fix update request for addresses
- 2e0293a FX-1: Process 400 error responses
- 4f85cf0 FX-1: Process 422 error responses
- 2118a75 FX-1: Use constant arrays, instead of static vars
- 40ed094 FX-1: Move abstract collection into collection directory
- a961a2c FX-1: Extend exception class descriptions
- 48dd07b FX-539: Add some validator tests
- 1632084 FX-539: Remove unused class
- bf68ff4 FX-539: Split README into separate files
- 70b6e74 FX-539: Update README
- 54484b8 FX-539: Make type optional
- 8007ba5 FX-539: Add tag_id/tag_name filter to people index request
- e2e2676 FX-539: Fail tests on exceptions
- 27629f6 FX-539: Update phpdoc
- b8ad323 FX-539: Update imports
- df17b76 FX-539: Add addrs tests, update tests
- 1ca6d13 FX-539: Add address endpoint
- 8cd6154 FX-516: Update README
- 0e42f85 FX-516: Add additional tests for attachments
- b3b813c FX-516: Add some more validators
- 5f36154 FX-516: Add missing validators
- ea7c6a8 FX-516: Add @api annotation to public classes
- fcff309 FX-516: Add interfaces for request builders, move common methods into traits
- 03aab60 FX-516: Add more interfaces for request classes, move common method into traits
- 980ff9a FX-516: Add attachments endpoint
- 8ecad8e FX-510: Pass external class map to serializer
- 889585b FX-510: Update README
- 219675e FX-510: Add tests for protocol endpoint
- 4cd9aca FX-510: Add missing base entity model
- 9d3aa01 FX-510: Add missing phpdoc
- 546610e FX-510: Use an abstract base class for response models
- 63c315e FX-510: Rename methods
- fc1cfdc FX-510: Fix phpstan issues
- acf1227 FX-510: Fix phpcs issues
- 6578c90 FX-510: Add "protocols" API endpoint
- 15b3500 FX-510: Rework api methods, avoid duplicate code
- 950d6c1 FX-1: Add xdebug version to prevent composer install fails
- 1fd5054 FX-511: Fix camel case class name usage
- 7cb5675 FX-511: Allow passing null values, reducing the final query parameters
- b4ce531 FX-511: Add constants for order by fields
- e8bdeb6 FX-511: Fix phpstan issues
- cf4e7ec FX-511: Use constants for search query fields
- afee739 FX-511: Catch JSON exception, return only exceptions of type ServiceException
- 2c7f48c FX-511: Update README
- 981bd6a FX-511: Rework tags endpoint, removed global tag create, delete#
- e0fef50 FX-511: Remove not required .json url ending, already done via Accept header
- 8f32828 FX-511: Update README
- fc5cc56 FX-511: Update tag creation/updating routine
- 5cf07ef FX-511: Removed obsolete show request and request builder
- a6762f7 FX-511: Extend tests to check webservice url and HTTP method
- 987932a FX-511: Simplify endpoint, remove need for tag Id in request
- 00e48f0 FX-511: Add tags processing for single person
- 04e238c FX-511: Update phpdoc
- 6b1a8f1 FX-511: Add query parameters only if not empty
- f232bfb FX-511: Add included tag response to person model
- ea3f6b0 FX-511: Prevent possible null pointer exception
- 4386405 FX-511: Update action methods CS, to match CS of other methods
- 05684bb FX-511: Add "list" request for tags
- 659c9eb FX-511: Fix phpstan issues
- 491e1b6 FX-511: Add basic tags requests and tests
- 1286628 FX-511: Add base request methods for "tags"
- c1af356 FX-511: Add tag model and collection
- 2426797 FX-511: Add "tags" API endpoint
- 0055ffb FX-507: Add missing phpdoc
- 13893eb FX-507: Fix camel case class name usage
- 0f78ae5 FX-507: Updat index/show method
- adb1251 FX-507: Update phpdoc
- 21b9b80 FX-507: Add background and country_code attributes to person
- 6cf7921 FX-507: Readd removed attribute
- 58c93e5 FX-507: Simplify endpoint, remove need for person Id in request
- e35a031 FX-507: Update person model and requests with salutation
- 3c24433 FX-507: Update phpdoc
- 510da2f FX-507: Add missing exception annotations
- a6b5277 FX-507: Extend error processing and add tests
- bffbedf FX-507: Update README
- 6fded49 FX-507: Add constants for fixed values
- f2b4618 FX-507: Added test for "delete" endpoint
- 05c4046 FX-507: Add test for API entry point class
- fee4ee3 FX-507: Fix method return types
- 4982e16 FX-507: Fix phpstan issues
- 1028b40 FX-507: Add search and filter validator
- 1003b53 FX-507: Extend class documentation
- 9bb675c FX-507: Fix IndexRequestBuilder
- b0e3c40 FX-507: Add filter trait, move duplicate code to trait
- 971dc82 FX-507: Add "search" action of people API endpoint
- f08bd9a FX-507: Add "merge" action of people API endpoint
- be4baa2 FX-507: Add "stats" action of people API endpoint
- b8e831a FX-507: Add "delete" action of people API endpoint
- 7722ae6 FX-507: Add "update" action of people API endpoint
- 8c91321 FX-507: Add "create" action of people API endpoint
- 659f142 FX-507: Add "show" action of people API endpoint
- e3b1c89 FX-507: Add people and person response model
- 58c62c6 FX-507: Add base test structure and first tests for people endpoint
- 7b032db FX-507: Add base people API action
- d96a3c4 FX-505: Add HTTP methods
- 57aba7e FX-505: Add JSON serializer
- d4575f1 FX-505: Add base structure of error plugin
- 726e29a FX-505: Add common exception classes
- 875f9d7 FX-505: Add API lazy loading provider class
- f586982 FX-505: Add base API entry point class
- 9b03b42 FX-505: Add a abstract collection
- f437a9d FX-505: Add URL builder class
- 36232a2 FX-505: Add some base interfaces
- 81531c6 FX-505: Add .gitlab-ci.yml configuration
- 9cea92c Initial commit

## Contributors

- Rico Sonntag

