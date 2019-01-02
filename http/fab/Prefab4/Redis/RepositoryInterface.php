<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Redis;

interface RepositoryInterface
{
    public function get(string $id): \Redis;

    public function setRedisFactory(FactoryInterface $factory);
}
