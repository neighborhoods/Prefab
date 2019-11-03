<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;

interface ExceptionInterface extends \Throwable, \JsonSerializable
{
    public function setCode(string $code): ExceptionInterface;

    public function addMessage(string $additionalMessage): ExceptionInterface;

    public function jsonSerialize();
}
