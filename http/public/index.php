<?php
declare(strict_types=1);
error_reporting(E_ALL);

use Neighborhoods\AreaService\Symfony\Component\DependencyInjection\ContainerBuilder\Facade;
use Neighborhoods\AreaService\Symfony\Component\DependencyInjection\ErrorHandler;
use Neighborhoods\AreaService\Symfony\Component\DependencyInjection\ExceptionHandler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Dumper\YamlDumper;
use Symfony\Component\Finder\Finder;
use Zend\Expressive\Application;

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

require_once __DIR__ . '/../vendor/autoload.php';
set_error_handler(new ErrorHandler());
set_exception_handler(new ExceptionHandler());
chdir(dirname(__DIR__));

/**  Self-called anonymous function that creates its own scope and keep the global namespace clean. */
(function () {
    $containerCacheFilePath = __DIR__ . '/../data/cache/container.php';
    if (file_exists($containerCacheFilePath)) {
        require_once $containerCacheFilePath;
        $containerBuilder = new ProjectServiceContainer();
    } else {
        /** @var ContainerBuilder $containerBuilder */
        $zendContainerBuilder = require __DIR__ . '/../config/container.php';
        $zendContainerBuilderApplicationServiceDefinition = $zendContainerBuilder->findDefinition(Application::class);
        (require_once __DIR__ . '/../config/pipeline.php')($zendContainerBuilderApplicationServiceDefinition);
        file_put_contents(__DIR__ . '/../data/cache/expressive.yml', (new YamlDumper($zendContainerBuilder))->dump());

        $containerBuilder = new ContainerBuilder();
        $discoverableDirectories[] = __DIR__ . '/../data/cache';
        $discoverableDirectories[] = __DIR__ . '/../fab';
        $discoverableDirectories[] = __DIR__ . '/../src';
        $containerBuilderFacade = (new Facade())->setContainerBuilder($containerBuilder);
        $containerBuilderFacade->addFinder((new Finder())->name('*.yml')->files()->in($discoverableDirectories));
        $containerBuilderFacade->assembleYaml();
        $applicationServiceDefinition = $containerBuilder->findDefinition(Application::class);

        /** @deprecated */
        (require_once __DIR__ . '/../config/routes.php')($applicationServiceDefinition, $containerBuilder);

        $containerBuilderFacade->build();
        file_put_contents($containerCacheFilePath, (new PhpDumper($containerBuilder))->dump());
    }
    /** @var Application $app */
    $application = $containerBuilder->get(Application::class);
    $application->run();
})();