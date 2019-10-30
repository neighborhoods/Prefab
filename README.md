# Prefab
A code generation tool. Takes the busywork out of building strongly-typed, patterned HTTP applications.

## Getting Started

### Running Prefab
- In your composer file, ensure you have your project name defined. Use the `composer-example.json` file, found in the root of Prefab, as a template
- Create your `dao.prefab.definition.yml` file as outlined [below](#Prefab Definition File Specification).
- From the root of your project run `./vendor/bin/prefab`
    - This will add all of the supporting files needed to create a working API endpoint

### Prefab Use Cases

Working examples of Prefab can be found in the [PrefabFitness repository](https://github.com/neighborhoods/PrefabFitness). 

## Prefab Definition File Specification

The purpose of this document is to define the components needed to generate an HTTP endpoint for a DAO from a `.prefab.definition.yml` file

The file must be named {DAONAME}.prefab.definition.yml and saved under `src/`. They should be stored in the same nested directory structure as you would like the machinery to be generated under `fab/`.  
- `dao`
    - `table_name`
        - Name of the database table containing the data that populates the DAO
    - `supporting_actor_group`
        - The collection of supporting actors you need generated for the actor
        - Can be one of `complete`, `collection`, or `minimal`
        - This field is optional and defaults to `complete`
        - See [below](#supporting-actor-groups) for more information
    - `http_route`
        - The http route that corresponds with the DAO
        - This field is optional
    - `http_verbs`
        - HTTP methods allowed for a DAO. Can include get, post, put, patch, and delete.
        - Note: Since mutative and destructive actions are not yet patterned for repositories, you will need to override the generated handler to call the proper repository method.
    - `identity_field`
        - Name of the database column containing the unique identifier for a given DAO
    - `properties`
        - The class properties of the DAO. Each property should have:
            - `data_type`
                - The type of object the property represents. This can be a primitive or a fully qualified namespaced object
                - Note: This used to be called `php_type` which is maintained for backwards compatibility
            - `record_key`
                - Name of the key containing the data that populates the class property
                - Note: This used to be called `database_column_name` which is still maintained for backwards compatibility 
            - `nullable`
                - Whether or not this property can be null. If true, the builder method will surround this property with isset() before attempting to set the value on the DAO
                - If not set, defaults to false
            - `created_on_insert`
                - This denotes properties that are not expected to be present before inserting the record into the database.
                - If true, the buildForInsert() method will surround this property with isset() before attempting to set the value on the DAO. However, the build() method will still require this property when building a record from the database.
                - If not set, defaults to false
                
Prefab also enforces
* A contract version namespace (e.g. `MV1`, `DOR1`, `RETS1`, etc.). This MUST be present under `src/`.
* A `{VENDOR}\{PRODUCT_NAME}` PSR-4 namespace convention (e.g. `Neighborhoods\Prefab`). This MUST be defined in `composer.json`.

### Example structure of a DAO yaml file:

Filename: `User.prefab.definition.yml`
```yaml
dao:
  table_name: mv1_user
  identity_field: id
  supporting_actor_group: complete
  http_route: /mv1/users/{searchCriteria:}
  http_verbs:
   - get
   - post
   - put
   - patch
   - delete
  properties:
    id:
      data_type: int
      record_key: id
      nullable: false
      created_on_insert: true
    email:
      data_type: string
      record_key: email
      nullable: true
    first_name:
      data_type: string
      record_key: first_name
      nullable: false
    last_name:
      data_type: string
      record_key: last_name
      nullable: false
    created_at:
      data_type: string
      record_key: created_at
      nullable: false
      created_on_insert: true
```
## Search Criteria

Search Criteria is a data mining query language (DMQL) utilized by Prefab applications to provide a flexible API that enables HTTP clients to define how they want to ask for data rather than services explicitly implementing each use case. Search Criteria consists of filters along with optional sort order and pagination instructions.

### Filters

Search Criteria filters are used to define the `WHERE` clause of a database query. Filters should be included as an array under the searchCriteria[filters] key. Each filter consists of the following:

Query Parameter Key: `searchCriteria[filters]`

| Key | Data Type | Description |
|-----|---------|------|
| `field` | string | The database column the filter applies to |
| `condition` | string | The condition to query by. See below for a full list of conditions |
| `values` | array | The values to include in a query. If a condition is used that only applies to a single value (eg. `=`) any values after the first will be ignored |
| `glue` | string | The condition to use when grouping filters together. Can be either `and` or `or` |

#### Conditions

| Key | Condition | Description |
|------|----|----------|
| `eq` | `=` | Will match values that `= values[0]` |
| `neq` | `<>` | Will match values that `!= values[0]` |
| `in` | `IN` | Will match values that are in `values` |
| `nin` | `NOT IN` | Will match values that are not in `values` |
| `lt` | `<` | Will match values that are less than `values[0]` |
| `lte` | `<=` | Will match values that are less than or equal to `values[0]` |
| `gt` | `>` | Will match values that are greater than `values[0]` |
| `gte` | `>=` | Will match values that are greater than or equal to `values[0]` |
| `like` | `LIKE` | Will match values that are like `values[0]` |
| `nlike` | `NOT LIKE` | Will match values that are not like `values[0]` |
| `is_null` | `IS NULL` | Will match values where `field` is null |
| `is_not_null` | `IS NOT NULL` | Will match values where `field` is not null |
| `st_contains` | `ST_Contains(field, st_geomfromtext(value))` | Will match values where `field` contains `values[0]` |
| `st_dwithin` | `ST_DWithin(field, center, radius)` | Will match values where `field` is within point `values['center']` with a radius of `values['radius']` |
| `st_within` | `ST_Within(field, st_buffer(st_geomfromtext(center), radius))` | Will match values where `field` is within point `values['center']` with a radius of `values['radius']` |
| `contains` | `field @> ARRAY[values]` | Will match values where json `field` contains all `values` |
| `overlaps` | `field && ARRAY[values]` | Will match values where json `field` contains any `values` |
| `jsonb_key_exist` | `jsonb_exists(field, value)` | Will match where `values[0]` exists as a jsonb key in `field`|

### Sort Order

A sort order is used to define the order in which data should be returned. It consists of an array with field and a direction.

Query Parameter Key: `searchCriteria[sortOrder]`

| Key | Description | 
|-----|------|
| `field` | Database column the sort applies to |
| `direction` | The order to be applied to the sort. Can be either `asc` or `desc` |

### Pagination

A page size can be defined in order to limit the number of results returned by a query. Set a page size by providing an integer under the key `searchCriteria[pageSize]`. You can retrieve additional pages of data by supplying a current page. Set the current page by providing an integer under the key `searchCriteria[currentPage]`.

## Supporting Actor Groups

Prefab supports generating different subsets of supporting actors to support various use cases. For information on how to specify a supporting actor group, see the [Prefab definition file specification](#prefab-definition-file-specification). The following supporting actor groups are available:
- `complete` - Generates all supporting actors.  This should be used when you need to be able to build an actor from storage and return it via HTTP.
    - Included supporting actors
        - Factory
        - Builder
        - Aware Traits
        - Repository
        - Map
        - Map Builder
        - Handler
- `collection` - Generates supporting actors for building and handling groups of typed objects. This is often used to represent a collection of actors in a JSON database column. 
    - Included supporting actors
        - Factory
        - Builder
        - Aware Traits
        - Map
        - Map Builder
- `minimal` - Generates the minimum number of supporting actors to build an actor. This can be used to represent a single, typed object.
    - Included supporting actors
        - Factory
        - Builder
        - Aware Traits
        
## Subset Container Buildable Directories

As Symfony containers get bigger, the response times for HTTP requests increase.  To prevent slow response times, Prefab supports user-defined subset container building. Prefab users can define what should be included in the Symfony container for each route, so only the necessary actors are initialized.  This buildable directory file is optional and Prefab will build the entirety of `src/` and `fab/` by default if the file is not found. If the file is present, then all routes MUST have a corresponding key with directories to be built.

- Note: On the first request, Prefab will write this file to disk as a PHP array in the directory `data/cache/Opcache/HTTPBuildableDirectoryMap`. When making changes to the Buildable Directory File, the cached file must be deleted in order for changes to be reflected in the code.  It is also highly recommended to ensure [Opcache](https://www.php.net/manual/en/book.opcache.php) is enabled in production to prevent a read from disk on every HTTP request. 

The top level key in the buildable directories file for each group should be the first two parts of the URI for the paths that use that container. If a key with the first two parts of the URI is not found, Prefab will then check for a key with just the first part of the URI.
- Examples
    - `neighborhoods.com/mv1/property/{searchCriteria}` would build all directories under the `mv1/property` key in the example file below
    - `neighborhoods.com/mv2/property/{searchCriteria}` would build all directories under the `mv2` key in the example file below

`buildable_directories` - Represents the directories of HTTP actors you would like to include for a given request. Each buildable directory will include the corresponding path under both `src/` and `fab/`. Since the `buildable_directories` represents paths, **forward slashes** (/) should be used as a separator.
- Example: 
    - A buildable directory of `MV1/property` will include `fab/MV1/property` (if it exists) and `src/MV1/property` (if it exists) in the container.

`welcome_baskets` - These are the namespaces of the HTTP machinery that Prefab generates that should be included in a request. Since `welcome_baskets` represent namespaces, **backslashes** (\\) should be used as a separator.
- Example: 
    - `Doctrine\DBAL` will include all files under the `Doctrine\DBAL` namespace that are in `fab/Prefab5/Doctrine/DBAL`.

`appended_paths` - These are any additional paths that you want included in your container that are not under `fab/` or `src/`. Paths are relative to the root of your project.  Since `appended_path` represents paths, **forward slashes** (/) should be used as a separator.

**Example**
```yaml
# Place this file at the root of your application.
mv1/property: # The URI to the component Handler.
  buildable_directories:
    - MV1/Property # The relative path to the directory of the component.
  welcome_baskets:
    - Doctrine\DBAL
    - PDO
    - Opcache
    - NewRelic
    - Zend\Expressive
    - SearchCriteria
  appended_paths:
    - some/other/dir
mv2: # The URI to the component Handler.
  buildable_directories:
    - MV2 # The relative path to the directory of the component.
  welcome_baskets:
    - Doctrine\DBAL
    - PDO
    - Opcache
    - NewRelic
    - Zend\Expressive
    - SearchCriteria
  appended_paths:
    - some/other/dir

```

By default, Symfony containers are built on the first HTTP request. Since this can add a significant amount of time to the first request, it is recommended that you prebuild your containers before serving production traffic. This can be accomplished by adding the following script to your `bin/` directory and including it as a `post-update-cmd` and/or `post-install-cmd` script in your `composer.json` file after `vendor/bin/prefab`.

``` php
#!/usr/bin/env php
<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
use ReplaceThisWithYourVendorName\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;

$primer = new ContainerBuilder\Primer();
$primer->primeContainers();

return;

```

## Debug Mode
Debug mode can be enabled by setting the environment variable `DEBUG_MODE=true`. Enabling debug mode will output additional details about exceptions and errors thrown during HTTP requests.  Note that this requires a valid container to be built in order to be used. If there is an error during container building (eg. A missing Symfony service file), you will not have the additional visibility provided by debug mode.

## Fitness
In order to capture the use cases for this product and to ensure this product is fit to handle each use case, every codebase that is designed to be composed into another codebase to perform useful work MUST have an accompanying `Fitness` repository.

The `Fitness` repository for `Prefab` is located at [`PrefabFitness`](https://github.com/neighborhoods/PrefabFitness).
