<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Protean\Container;

use Psr\Container\ContainerInterface;

interface BuilderInterface
{
    public function build(): ContainerInterface;

    public function registerServiceAsPublic(string $serviceId): BuilderInterface;

    public function setCanBuildZendExpressive(bool $can_build_zend_expressive): BuilderInterface;

    public function setCanCacheContainer(bool $can_cache_container): BuilderInterface;

    public function setCachedContainerFileName(string $cached_container_file_name): BuilderInterface;
}
