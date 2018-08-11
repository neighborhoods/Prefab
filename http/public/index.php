<?php
declare(strict_types=1);
ini_set('assert.exception', '1');
error_reporting(E_ALL);

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Symfony\Component\DependencyInjection\ContainerBuilder\Facade;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\Finder\Finder;
use Zend\Expressive\Application;

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

chdir(dirname(__DIR__));
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keep the global namespace clean.
 */
(function () {
    $containerCacheFilePath = __DIR__ . '/../data/cache/container.php';
    if (file_exists($containerCacheFilePath)) {
        require_once $containerCacheFilePath;
        $containerBuilder = new ProjectServiceContainer();
    } else {
        /** @var ContainerBuilder $containerBuilder */
        $containerBuilder = require __DIR__ . '/../config/container.php';
        $applicationServiceDefinition = $containerBuilder->findDefinition(Application::class);
        (require_once __DIR__ . '/../config/pipeline.php')($applicationServiceDefinition);
        $containerBuilderFacade = (new Facade())->setContainerBuilder($containerBuilder);
        $discoverableDirectories[] = __DIR__ . '/../fab';
        $discoverableDirectories[] = __DIR__ . '/../src';
        $containerBuilderFacade->addFinder((new Finder())->name('*.yml')->files()->in($discoverableDirectories));
        $containerBuilderFacade->assembleYaml();
        (require_once __DIR__ . '/../config/routes.php')($applicationServiceDefinition, $containerBuilder);
        $containerBuilderFacade->build();
        file_put_contents($containerCacheFilePath, (new PhpDumper($containerBuilder))->dump());
    }
    /** @var Application $app */
    $application = $containerBuilder->get(Application::class);
    $application->run();
})();
