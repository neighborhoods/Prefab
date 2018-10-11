<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNS;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNSInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): DNSInterface;
}
