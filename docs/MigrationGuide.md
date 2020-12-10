# Migrating From v6 to v7

We removed all New Relic components from Prefab v7, keeping the support
for [DatadogComponent](https://github.com/neighborhoods/DatadogComponent).

## Breaking changes

* Mandatory: Remove direct or indirect usages/references in your code to Prefab5/NewRelic.php class.
* Optional: Remove all NewRelic references in Welcome baskets or in Filter paths.

### Using a Proteam container builder

Prefab v6

``` php
$proteanContainerBuilder = new Prefab5\Protean\Container\Builder();
$proteanContainerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter('Prefab5/Doctrine');
$proteanContainerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter('Prefab5/PDO');
$proteanContainerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter('Prefab5/NewRelic');
$proteanContainerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter('Prefab5/Opcache');

// Further builder configuration

$proteanContainer = $proteanContainerBuilder->build();
```

Prefab v7

``` php
$proteanContainerBuilder = new Prefab5\Protean\Container\Builder();
$proteanContainerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter('Prefab5/Doctrine');
$proteanContainerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter('Prefab5/PDO');
$proteanContainerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter('Prefab5/Opcache');

// Further builder configuration

$proteanContainer = $proteanContainerBuilder->build();
```

### Using a Prefab user-defined subset of containers

If you are using
a [Prefab user-defined subset of containers](https://github.com/neighborhoods/Prefab/tree/feature/container_only#subset-container-buildable-directories)
remove the welcome basket as shown below.

Prefab v6 global config *http-buildable-directories.yml* in project root

```yaml
ComponentName/DAO:
  buildable_directories:
    - ComponentName
  welcome_baskets:
    - Doctrine\DBAL
    - PDO
    - Opcache
    - NewRelic
    - Zend\Expressive
    - SearchCriteria
```

Prefab v7 global config *http-buildable-directories.yml* in project root

```yaml
ComponentName/DAO:
  buildable_directories:
    - ComponentName
  welcome_baskets:
    - Doctrine\DBAL
    - PDO
    - Opcache
    - Zend\Expressive
    - SearchCriteria
```
