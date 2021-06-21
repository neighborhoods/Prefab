# Migrating from v7 to v8

Protean Container Builder is replaced with the [Container Builder Component](https://github.com/neighborhoods/DependencyInjectionContainerBuilderComponent).  
The migration guide from v6 to v7 is available [here](https://github.com/neighborhoods/Prefab/blob/7.x/docs/MigrationGuide.md).

## Breaking changes

Major changes have been made to vendor classes as well as to the prefabricated classes. Run `vendor/bin/prefab` to obtain the latest prefabricated classes.

### Prefabricated classes

`Neighborhoods\Product\Prefab5\Protean\Container\Builder` class has been removed. Replace it with `Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder`.

Prefab 7

``` php
$proteanContainerBuilder = new Prefab5\Protean\Container\Builder();
$proteanContainerBuilder->getFilesystemProperties()->setRootDirectoryPath(realpath(dirname(__DIR__)));
$proteanContainerBuilder->setContainerName('ContainerName');
$proteanContainerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter('ProductComponent');
$proteanContainerBuilder->getDiscoverableDirectories()->appendPath('vendor/neighborhoods/throwable-diagnostic-component/src');
$proteanContainerBuilder->getDiscoverableDirectories()->getWelcomeBaskets()->addWelcomeBasket('Opcache');
$proteanContainerBuilder->registerServiceAsPublic(SomeInterface::class);
// Further builder configuration

$proteanContainer = $proteanContainerBuilder->build();
$instance = $proteanContainer->get(SomeInterface::class);
```

Prefab 8

``` php
$rootDirectory = realpath(dirname(__DIR__));
$cacheHandler = (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\SymfonyConfigCacheHandler\Builder())
    ->setName('ContainerName')
    ->setCacheDirPath($rootDirectory . '/data/cache')
    ->setDebug(false)
    ->build();
$container = (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder())
    ->setContainerBuilder(new \Symfony\Component\DependencyInjection\ContainerBuilder())
    ->setRootPath($rootDirectory)
    ->setCacheHandler($cacheHandler)
    ->addSourcePath('src/ProductComponent')
    ->addSourcePath('fab/ProductComponent')
    ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/src')
    ->addSourcePath('fab/Prefab5/Opcache')
    ->makePublic(SomeInterface::class)
    ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass())
    ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass())
// Further builder configuration
    ->build();

$instance = $container->get(SomeInterface::class);
```

* `TinyContainerBuilder` doesn't know about Zend Expressive. If you need to build the Zend Expressive DI YAML use [ZendExpressiveServicesBuilder](https://github.com/neighborhoods/Prefab/blob/8.x/http/fab/Prefab5/HTTPBuildableDirectoryMap/ZendExpressiveServicesBuilder.php). To avoid repeating regeneration of the file although the container is cached, use DICBC `CacheHandler`'s `hasInCache()` and `getFromCache()` methods before using `ZendExpressiveServicesBuilder`.

Prefab 7

``` php
$proteanContainerBuilder = new Prefab5\Protean\Container\Builder();
$proteanContainerBuilder->setContainerName('ContainerName');
$proteanContainerBuilder->getFilesystemProperties()->setRootDirectoryPath(realpath(dirname(__DIR__)));
$proteanContainerBuilder->setCanBuildZendExpressive(true);
// Further builder configuration
return $proteanContainerBuilder->build();
```

Prefab 8

``` php
$rootDirectory = realpath(dirname(__DIR__));
$cacheHandler = (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\SymfonyConfigCacheHandler\Builder())
    ->setName('ContainerName')
    ->setCacheDirPath($rootDirectory . '/data/cache')
    ->setDebug(false)
    ->build();

if ($cacheHandler->hasInCache()) {
    return $cacheHandler->getFromCache();
}

$filesystemProperties = new ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\FilesystemProperties();
$filesystemProperties->setRootDirectoryPath($rootDirectory);
$zendExpressiveServicesBuilder = new ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ZendExpressiveServicesBuilder();
$zendExpressiveServicesBuilder->setHTTPBuildableDirectoryMapFilesystemProperties($filesystemProperties);
$zendPath = $zendExpressiveServicesBuilder->buildDIYAMLFile();
return (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder())
    ->setContainerBuilder(new \Symfony\Component\DependencyInjection\ContainerBuilder())
    ->setCacheHandler($cacheHandler) // The container will be cached
    ->setRootPath($rootDirectory)
    ->addSourcePath($zendPath)
// Further builder configuration
    ->build();
```
 * `Neighborhoods\Product\Prefab5\Protean\Container\Builder\FilesystemProperties` and the interface were moved to the `Neighborhoods\Product\Prefab5\HTTPBuildableDirectoryMap` namespace. It is no longer aware of the Protean Container Builder and lost the `getSymfonyContainerFilePath()` method. You **probably don't** use this class.
 * `Neighborhoods\Product\Prefab5\Protean\Container\Builder\DiscoverableDirectories` and the interface were moved to the `Neighborhoods\Product\Prefab5\HTTPBuildableDirectoryMap` namespace. It lost all business logic and is converted to a plain data access object. You might use this class indirectly, e.g. `$proteanContainerBuilder->getDiscoverableDirectories()`. After replacing Protean Container Builder as shown above you shouldn't need it anymore.
 * `Neighborhoods\Product\Prefab5\WelcomeBaskets` and the interface have been removed. It is **unlikely** that you use them directly.
* `Neighborhoods\Product\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder` requires you to set the application root directory path on it, instead of passing a protean container builder having it set. It is **unlikely** that you use this class directly. If you use it have a look at changes on the `Neighborhoods\Product\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder\Primer` class.

### Vendor classes

 * `Neighborhoods\Prefab\Protean\Container\Builder` class has been removed. It is **unlikely** that you use this class directly. If you use it, have a look at changes on `Neighborhoods\Prefab\Prefab` which used it as well.
 * `Neighborhoods\Prefab\Prefab` requires you to set the application root directory path on it, instead of passing a protean container builder having it set. It is **unlikely** that you use this class directly. If you use it have a look at changes on the `bin/prefab` script.

## Improvements

Until Prefab 8.6 the template for the Handler's was converting repository exceptions into `SearchCriteriaBuilderException`.

Check if your handler code is based on the template. If so please modify it according to [this commit](https://github.com/neighborhoods/Prefab/commit/303c343bae81e01247b7fcb3d0e0ce2a47b19541).
