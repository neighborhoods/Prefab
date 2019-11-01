<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO;

interface BuilderInterface
{
    public function getPdo(): \PDO;

    public function setUserName(string $userName): BuilderInterface;

    public function setPassword(string $password): BuilderInterface;

    public function setOptions(array $options): BuilderInterface;
}
