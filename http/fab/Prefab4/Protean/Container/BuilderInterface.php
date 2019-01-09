<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Protean\Container;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Protean\Container\Builder\FilesystemProperties;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Protean\Container\Builder\FilesystemPropertiesInterface;
use Psr\Container\ContainerInterface;

interface BuilderInterface
{
    public function build(): ContainerInterface;

    public function registerServiceAsPublic(string $serviceId): BuilderInterface;

    public function setCanBuildZendExpressive(bool $canBuildZendExpressive): BuilderInterface;

    public function setContainerName(string $containerName): BuilderInterface;

    public function getContainerName(): string;

    public function getFilesystemProperties(): FilesystemPropertiesInterface;
}
