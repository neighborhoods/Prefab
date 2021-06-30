## Subset Container Buildable Directories

As Symfony containers get bigger, the response times for HTTP requests rise.  To prevent slow response times, Prefab implemented user-defined subset container building. Prefab users can define what is included in a container for individual requests, so only what is needed is included in each container. The purpose of this document is to define the usage of the `http-buildable-directories.yml` file.

The top level key in the buildable directories file for each group should be the first two parts of the URI for the paths that use that container. Example: `property_service.neighborhoods.com/MV1/property/{searchCriteria}` would build all directories under the `MV1/property` key in the file below.

`buildable_directories` - These are the directories of your actors that you want to include for a request. Example: Having an `MV1/property` buildable directory will include `fab/MV1/property` and `src/MV1/property` in the container.  
`buildable_directories` are optional. If not provided or empty the whole `src` and `fab` folders will be included.

`welcome_baskets` - These are the namespaces of actors that Prefab generates that would like to include in a request. Example: `Doctrine\DBAL` will include all of the files under the `Doctrine\DBAL` namespace that are in `fab/Prefab5/Doctrine/DBAL`.  
`welcome_baskets` are optional. If not provided or empty the whole `fab/Prefab5` folder will be included.

`appended_paths` - These are any additional paths that you may want included in your container. Paths are relative to the root of your project. `appended_paths` are optional.

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

```php
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

Container priming uses the environment variables and bakes them into the container, therefore container priming should be triggered by the entrypoint script.

## Preloading

[Preloading](https://www.php.net/manual/en/opcache.preloading.php) has been introduced in PHP 7.4.

Preloading the built HTTP containers significantly reduces the response time. In addition to preloading the HTTP containers also preload Doctrine.

First write the preloading script, an example is shown below.

```php
#!/usr/bin/env php
<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL;

(new ContainerBuilder\Preloader())->preload();
(new DBAL\Preloader())->preload();

return;

```

The preloading script should be added to the opcache configuration after the containers are primed.

```bash
bin/prime_http_containers.php || exit 1
echo "opcache.preload=/var/www/html/project/bin/preload.php" >> /usr/local/etc/php/conf.d/opcache.ini
```

In addition to specifying the preload script, your opcache configuration has to specify the preloading user, which cannot be the root user.

```ini
opcache.preload_user=www-data
;display_startup_errors=1
```

The preloading will silently error unless you set the `display_startup_errors` flag which will print the error message in the container log.
