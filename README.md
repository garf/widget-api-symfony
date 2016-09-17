Test task (My code example)
========================

This is a small test application which enables already registered users 
(registration etc not done within the scope of this task) to request a widget 
that contains the overall rating of the user in different formats.

So we should have a User entity which can be identified by a UUID 
and has a relation to its Reviews. 
Every single review has a property "rating" (integer 0-100%). 
The review score in the rendered/returned widget response should be the average rating 
in percent of all the user's reviews rounded to an integer.

As mentioned we want to support different formats:

 - xml 
 - json
 - html
 - png

It should be possible to request the widget via:

`http://domain-of-the-app/widget/{{UUID}}.{{format}}`

So for the png version for the user with UUID=123e4567-e89b-12d3-a456-426655440000:

`http://domain-of-the-app/widget/123e4567-e89b-12d3-a456-426655440000.png`


You can define the exact structure for the different formats yourself 
(e.g. size & color of the png, structure of the xml, json & html response). 
Important is just that the overall rating percentage is included in the response.

The XML response might look similar to this for example:

```xml
<ratingWidget>
    <averageRating scale="100">88</averageRating>
</ratingWidget>
```

Other formats for the rating widget will follow in the future 
so the solution should be flexible and require minimal/no changes to existing classes 
in case a new format is added.

### Other requirements:

 - Symfony 3
 - MySQL or Postgres database
 - compliant with PSR-1/2
 - Some basic PHPUnit unit & functional tests (WebTestCase for Controller tests)

## Installation

- clone repository
- `composer install`
- `bin/console doctrine:schema:create`
- `bin/console database:seed`
- follow the next links:
    - `domain.dev/widget/{UUID}.xml`
    - `domain.dev/widget/{UUID}.json`
    - `domain.dev/widget/{UUID}.html`
    - `domain.dev/widget/{UUID}.png`
    
