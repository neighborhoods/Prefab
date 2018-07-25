<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Redis;

interface RepositoryInterface
{
    public function get(string $id): \Redis;

    public function setRedisFactory(FactoryInterface $factory);
}
