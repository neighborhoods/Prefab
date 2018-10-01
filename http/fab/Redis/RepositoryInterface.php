<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis;

interface RepositoryInterface
{
    public function get(string $id): \Redis;

    public function setRedisFactory(FactoryInterface $factory);
}