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
