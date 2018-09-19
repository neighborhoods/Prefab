<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

interface GeneratorMetaInterface
{
    public function getActorNamespace(): string;

    public function setActorNamespace(string $actorNamespace): GeneratorMetaInterface;

    public function getActorFilePath(): string;

    public function setActorFilePath(string $actorFilePath): GeneratorMetaInterface;
}
