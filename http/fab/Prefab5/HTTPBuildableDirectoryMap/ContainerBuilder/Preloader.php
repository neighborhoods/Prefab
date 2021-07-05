<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;

use Psr\Container\ContainerInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\BuildableDirectoryFileNotFound;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;
use Throwable;
use Zend\Expressive\Application;

class Preloader implements PreloaderInterface
{
    private $applicationRun = false;

    public function preload() : PreloaderInterface
    {
        // Preload containers
        $rootDirectoryPath = __DIR__ . '/../../../../';
        try {
            $httpBuildableDirectoryMap = (new Opcache\HTTPBuildableDirectoryMap())->getBuildableDirectoryMap();

            // Preload all subcontainers when http-buildable-directories.yml exists
            foreach ($httpBuildableDirectoryMap as $directoryGroup => $directoryMap) {
                $this->preloadContainer(
                    (new ContainerBuilder())
                        ->setRootDirectoryPath($rootDirectoryPath)
                        ->setDirectoryGroup($directoryGroup)
                        ->setBuildableDirectoryMap([$directoryGroup => $directoryMap])
                        ->build()
                );
            }
        } catch (BuildableDirectoryFileNotFound\Exception $exception) {
            // http-buildable-directories.yml not found. Preload unified HTTP container
            $this->preloadContainer(
                (new ContainerBuilder())
                    ->setRootDirectoryPath($rootDirectoryPath)
                    ->build()
            );
        }

        $this->preloadCommon();

        return $this;
    }

    private function preloadContainer(ContainerInterface $container): PreloaderInterface
    {
        // Getting application instance loads the microframework
        // and hander with injected dependencies.
        $application = $container->get(Application::class);

        // Application may be run only once. Running multiple times triggers a fatal error.
        if (!$this->applicationRun) {
            $this->applicationRun = true;
            // Running the application forces the microframework to instantiate a bunch of classes.
            // The run will fail since preloading is performed before any HTTP request arrives.
            // Thanks to the instantiated classes, HTTP requests will be processed faster.
            try {
                $application->run();
            } catch (Throwable $throwable) {
            }
        }

        return $this;
    }

    private function preloadCommon(): PreloaderInterface
    {
        // Typical response. Handlers create it using the 'new' keyword, not a factory
        class_exists(\Zend\Diactoros\Response\JsonResponse::class);

        // Preload the index.php and classes used inside it
        opcache_compile_file(__DIR__ . '/../../../../public/index.php');
        class_exists(\Fig\Http\Message\StatusCodeInterface::class);
        class_exists(Prefab5\ErrorHandler::class);
        class_exists(Prefab5\ExceptionHandler::class);
        class_exists(Prefab5\HTTP::class);
        class_exists(Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder::class);
        class_exists(Prefab5\Logger::class);

        // Preload exceptions
        class_exists(Prefab5\HTTP\Exception::class);
        class_exists(Prefab5\HTTP\SearchCriteriaBuilderException::class);

        // Additional classes needed when exception occurs
        class_exists(\Psr\Log\LogLevel::class);
        \DDTrace\GlobalTracer::get()->getActiveSpan();

        return $this;
    }
}
