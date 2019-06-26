<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup;

use Neighborhoods\Prefab\BuildConfigurationInterface;

interface MinimalInterface
{
    public function getSupportingActorConfig() : array;

    public function setDaoName(string $daoName) : MinimalInterface;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : MinimalInterface;

}
