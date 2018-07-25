<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Redis;

use neighborhoods\~~PROJECT NAME~~\Redis;

class Repository implements RepositoryInterface
{
    use Redis\Factory\AwareTrait;
    use Redis\Map\AwareTrait;

    public function get(string $id): \Redis
    {
        if (!isset($this->getRedisMap()[$id])) {
            $this->getRedisMap()[$id] = $this->getRedisFactory()->create();
        }

        return $this->getRedisMap()[$id];
    }
}
