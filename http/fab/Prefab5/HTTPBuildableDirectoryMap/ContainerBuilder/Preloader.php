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
        try {
            $application->run();
        } catch (Throwable $throwable) {
        }

        return $this;
    }

    private function preloadCommon(): PreloaderInterface
    {
        class_exists(\Zend\Diactoros\Response\JsonResponse::class);
        include __DIR__ . '/../../../../public/index.php';

        return $this;
    }
}
