<?php


namespace Neighborhoods\Prefab;


use Neighborhoods\Prefab\Protean\Container\Builder;

class Prefab implements PrefabInterface
{

    use Builder\AwareTrait;

    public function generate() : PrefabInterface
    {
        $this
            ->getProteanContainerBuilder()
            ->build()
            ->get(GeneratorInterface::class)
            ->setProjectDir(__DIR__ . '/../../../../')
            ->generate();

        return $this;
    }
}
