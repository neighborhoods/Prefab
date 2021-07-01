<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;

use Psr\Container\ContainerInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\BuildableDirectoryFileNotFound;
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
            // No directory map file found. Preload unified HTTP container
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
        $application = $container->get(Application::class);

        // Application may be run only once.
        if (!$this->applicationRun) {
            $this->applicationRun = true;
            try {
                $application->run();
            } catch (Throwable $throwable) {
            }
        }

        return $this;
    }

    private function preloadCommon(): PreloaderInterface
    {
        class_exists(\Zend\Diactoros\Response\JsonResponse::class);
        opcache_compile_file(__DIR__ . '/../../../../public/index.php');
        class_exists(\Fig\Http\Message\StatusCodeInterface::class);
        class_exists(\ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\ErrorHandler::class);
        class_exists(\ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\ExceptionHandler::class);
        class_exists(\ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTP::class);
        class_exists(\ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder::class);
        class_exists(\ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger::class);

        return $this;
    }
}
