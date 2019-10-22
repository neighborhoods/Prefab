<?php

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

interface WriterInterface
{
    public function write() : WriterInterface;

    public function setFabricationSpecification(FabricationSpecificationInterface $fabricationSpecification) : WriterInterface;

    public function setWritePath(string $writePath) : WriterInterface;
}
