<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder\MapInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;

class Builder implements BuilderInterface
{
    protected $records;

    public function build() : MapInterface
    {
        $map = new ContainerBuilder\Map();

        foreach ($this->getRecords() as $group) {
            $builder = new ContainerBuilder();
            $item = $builder->setBuildableDirectoryMap($group)
                ->setDirectoryGroup(array_key_first($group))
                ->setPrefab5HttpBuildableDirectoryMapContainerBuilder((new Protean\Container\Builder()))
                ->getContainerBuilder();
            $map[] = $item;
        }

        return $map;
    }

    protected function getRecords() : array
    {
        if ($this->records === null) {
            throw new \LogicException('Builder records has not been set.');
        }

        return $this->records;
    }

    public function setRecords(array $records) : BuilderInterface
    {
        if ($this->records !== null) {
            throw new \LogicException('Builder records is already set.');
        }

        $this->records = $records;

        return $this;
    }
}
