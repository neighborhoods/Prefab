<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNS;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNSInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DNSInterface
    {
        return clone $this->getOpcacheDNS();
    }
}
