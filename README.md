# Neighborhoods Prefab
A code generation tool. Takes the busywork out of building [Protean](https://github.com/neighborhoods/protean)-compliant applications.

## Protean Docs and FAQs
Protean is an application architecture specification. The specification is canonically defined in https://github.com/neighborhoods/protean. Docs and FAQs can be bound there.

## Running Prefab
- In your composer file, ensure you have your project name defined. Use the `composer-example.json` file, found in the root of Prefab, as a template
- Create your `dao.prefab.definition.yml` file as outlined [here](./docs/PrefabDefinition.md).
- From the root of your project run `./vendor/bin/prefab`
    - This will add all of the supporting files needed to create a working API endpoint

## Feature Requests

Refer to the [Feature Request LDR](docs/Feature-Request-Process-LDR.md) for information on how to submit a new feature request to the Prefab owners.

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
        - Note: Since mutatitve and destuctive actions are not yet patterned for repositories, you will need to override the generated handler to call the proper repository method.
    - `identity_field`
        - Name of the database column containing the unique identifier for a given DAO
    - `properties`
        - The class properties of the DAO. Each property should have:
            - `php_type`
                - The type of object the property represents. This can be a primitive or a fully qualified namespaced object
            - `record_key`
                - Name of the key containing the data that populates the class property
                - Note: This used to be called `database_column_name` which is still maintained for backwards compatibility 
            - `nullable`
                - Whether or not this property can be null. If true, the builder method will surround this property with isset() before attempting to set the value on the DAO
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
      php_type: int
      record_key: id
      nullable: false
    email:
      php_type: string
      record_key: email
      nullable: true
    first_name:
      php_type: string
      record_key: fname
      nullable: false
    last_name:
      php_type: string
      record_key: lname
      nullable: false
```

## Supporting Actor Groups

There are multiple use cases for using Prefab to generate the supporting actors for a given DAO. Prefab supports generating different subsets of actors to support those use cases. For information on how to specify a supporting actor group, see the [Prefab definition file specification](#prefab-definition-file-specification) above. The following supporting actor groups are available:
- `complete` - Generates all supporting actors.  This should be used when you need to be able to build an actor from storage and return it via HTTP.
    - Included supporting actors
        - Factory
        - Builder
        - AwareTraits
        - Repository
        - Map
        - Map Builder
        - Handler
- `collection` - Generates supporting actors for building and handling groups of strongly typed objects. This is often used to represent a collection of actors in a JSON database column. 
    - Included supporting actors
        - Factory
        - Builder
        - AwareTraits
        - Map
        - Map Builder
- `minimal` - Generates the minimum number of supporting actors to build an actor. This can be used to represent a single, strongly typed object.
    - Included supporting actors
        - Factory
        - Builder
        - AwareTraits
        
## Subset Container Buildable Directories

As Symfony containers get bigger, the response times for HTTP requests rise.  To prevent slow response times, Prefab implemented user-defined subset container building. Prefab users can define what is included in a container for individual requests, so only what is needed is included in each container. The purpose of this document is to define the usage of the `http-buildable-directories.yml` file.

The top level key in the buildable directories file for each group should be the first two parts of the URI for the paths that use that container. Example: `property_service.neighborhoods.com/MV1/property/{searchCriteria}` would build all directories under the `MV1/property` key in the file below.

`buildable_directories` - These are the directories of your actors that you want to include for a request. Example: Having an `MV1/property` buildable directory will include `fab/MV1/property` and `src/MV1/property` in the container.

`welcome_baskets` - These are the namespaces of actors that Prefab generates that would like to include in a request. Example: `Doctrine\DBAL` will include all of the files under the `Doctrine\DBAL` namespace that are in `fab/Prefab5/Doctrine/DBAL`.

`appended_paths` - These are any additional paths that you may want included in your container. Paths are relative to the root of your project. 

**Example**
```yaml
MV1/property:
  buildable_directories:
    - MV1/Property
  welcome_baskets:
    - Doctrine\DBAL
    - PDO
    - Opcache
    - NewRelic
    - Zend\Expressive
    - SearchCriteria
  appended_paths:
    - some/other/dir
MV2:
  buildable_directories:
    - MV2
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

Since there are now many containers that will be built, the legacy method of Bakery pre-baking the containers using `include index.php;` will no longer work. In order to prebuild your containers, add the following script to your `bin/` directory and include the script in your `composer.json` file after `vendor/bin/prefab` but before `vendor/bin/bakery`

``` php
#!/usr/bin/env php
<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;

$primer = new ContainerBuilder\Primer();
$primer->primeContainers();

return;

```

## Debug Mode
- Debug mode can be enabled by setting the environment variable `DEBUG_MODE = "true"`

## Fitness
In order to capture the use cases for this product, and to ensure that this product is fit to handle each use case, every codebase that is designed to be composed into another codebase to perform useful work MUST have an accompanying `Fitness` repository.

The `Fitness` repository for `Prefab` is located in [`PrefabFitness`](https://github.com/neighborhoods/PrefabFitness).

All features and changes to `Prefab` MUST have an accompanying use case in this `Fitness` repository and MUST have an adopted RFC in `Protean`.

Bugfixes MUST have a PR with all `Prefab` owners approval and an accompanying ticket that is linked in the PR. Bugfixes SHOULD have a use case in the `Fitness` repository, but do not need an adopted RFC in `Protean`.
