<?php
declare(strict_types=1);

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\BuildableDirectoryFileNotFound;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder;

class Prebuilder implements PrebuilderInterface
{
    public function prebuildContainers() : PrebuilderInterface
    {
        try {
            $httpBuildableDirectoryMap = (new Opcache\HTTPBuildableDirectoryMap())->getBuildableDirectoryMap();
        } catch (BuildableDirectoryFileNotFound\Exception $exception) {
            // No directory map file found. Nothing to build
            return $this;
        }

        foreach ($httpBuildableDirectoryMap as $key => $values) {
            (new ContainerBuilder())
                ->setDirectoryGroup($key)
                ->setBuildableDirectoryMap([$key => $values])
                ->getContainerBuilder()
                ->build();
        }

        $mapBuilder = new ContainerBuilder\Map\Builder();
        $containerBuilderMap = $mapBuilder->setRecords($httpBuildableDirectoryMap)->build();

        foreach ($containerBuilderMap as $builder) {
            $builder->getContainerBuilder()->build();
        }

        return $this;
    }
}
