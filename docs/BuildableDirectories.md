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
