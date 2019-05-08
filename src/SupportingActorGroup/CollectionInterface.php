<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup;

use Neighborhoods\Prefab\BuildConfigurationInterface;

interface CollectionInterface
{
    public function getSupportingActorConfig() : array;

    public function setDaoName(string $daoName) : CollectionInterface;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : CollectionInterface;

}
