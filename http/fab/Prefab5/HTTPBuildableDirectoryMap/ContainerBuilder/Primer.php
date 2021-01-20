<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\BuildableDirectoryFileNotFound;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;

class Primer implements PrimerInterface
{
    public function primeContainers() : PrimerInterface
    {
        try {
            $httpBuildableDirectoryMap = (new Opcache\HTTPBuildableDirectoryMap())->getBuildableDirectoryMap();
        } catch (BuildableDirectoryFileNotFound\Exception $exception) {
            // No directory map file found. Nothing to build
            return $this;
        }

        foreach ($httpBuildableDirectoryMap as $key => $values) {
            $containerBuilder = (new ContainerBuilder())
                ->setRootDirectoryPath(__DIR__ . '/../../../../')
                ->setDirectoryGroup($key)
                ->setBuildableDirectoryMap([$key => $values])
                ->getContainerBuilder();

            $containerBuilder->build();
        }

        return $this;
    }
}
