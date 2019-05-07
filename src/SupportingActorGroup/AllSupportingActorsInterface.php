<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup;

use Neighborhoods\Prefab\BuildConfigurationInterface;

interface AllSupportingActorsInterface
{
    public function getSupportingActorConfig() : array;

    public function setDaoName(string $daoName) : AllSupportingActorsInterface;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : AllSupportingActorsInterface;

}
