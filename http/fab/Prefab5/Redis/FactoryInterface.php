<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Redis;

interface FactoryInterface
{
    public const PROP_HOST = 'host';
    public const PROP_PORT = 'port';

    public const REDIS_OPT_READ_TIMEOUT = 3;

    public function create(): \Redis;

    public function setPort(int $port): FactoryInterface;

    public function setHost(string $host): FactoryInterface;

    public function addOption(int $optionName, string $optionValue): FactoryInterface;
}
