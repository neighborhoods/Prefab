<?php
declare(strict_types=1);
ini_set('assert.exception', '1');
error_reporting(E_ALL);

use Neighborhoods\Pylon\DependencyInjection\ContainerBuilder\Facade;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\Finder\Finder;

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

chdir(dirname(__DIR__));
require __DIR__ . '/../vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keep the global namespace clean.
 */
(function () {
    $containerCacheFilePath = __DIR__ . '/../data/cache/container.php';
    if (file_exists($containerCacheFilePath)) {
        require_once $containerCacheFilePath;
        $containerBuilder = new ProjectServiceContainer();
    } else {
        /** @var \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder */
        $containerBuilder = require __DIR__ . '/../config/container.php';
        $applicationServiceDefinition = $containerBuilder->findDefinition(\Zend\Expressive\Application::class);
        (require __DIR__ . '/../config/pipeline.php')($applicationServiceDefinition);
        $discoverableDirectories[] = __DIR__ . '/../src';
        $finder = new Finder();
        $finder->name('*.yml');
        $finder->files()->in($discoverableDirectories);
        $containerBuilderFacade = new Facade();
        $containerBuilderFacade->setContainerBuilder($containerBuilder);
        $containerBuilderFacade->addFinder($finder);
        $containerBuilderFacade->assembleYaml();
        (require __DIR__ . '/../config/routes.php')($applicationServiceDefinition, $containerBuilder);
        $containerBuilderFacade->build();
        $dumper = new PhpDumper($containerBuilder);
        file_put_contents($containerCacheFilePath, $dumper->dump());
    }
    /** @var \Zend\Expressive\Application $app */
    $application = $containerBuilder->get(\Zend\Expressive\Application::class);
    $application->run();
})();