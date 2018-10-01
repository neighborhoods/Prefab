<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface StringReplacerInterface
{
    public function replacePlaceholders() : string;

    public function setFile(string $file) : StringReplacerInterface;

    public function getNamespace() : string;

    public function setNamespace(string $namespace) : StringReplacerInterface;
}
