<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup;

use Neighborhoods\Prefab\BuildConfigurationInterface;

interface TypedObjectInterface
{
    public function getSupportingActorConfig() : array;

    public function setDaoName(string $daoName) : TypedObjectInterface;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : TypedObjectInterface;

}
