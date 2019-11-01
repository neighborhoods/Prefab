<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;

interface DNSInterface
{
    public const CACHE_DIRECTORY_PATH = __DIR__ . '/../../../data/cache/Opcache/DNS';

    public function getIp(): string;

    public function setHost(string $host_name): DNSInterface;

    public function flush(): DNSInterface;
}
