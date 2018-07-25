<?php
declare(strict_types=1);

namespace Neighborhoods\~\Redis;

interface RepositoryInterface
{
    public function get(string $id): \Redis;

    public function setRedisFactory(FactoryInterface $factory);
}
