<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\BuilderInterface;

use Neighborhoods\Prefab\Console\GeneratorMetaInterface;

interface GeneratorInterface
{
    public function generate(): GeneratorInterface;

    public function setMeta(GeneratorMetaInterface $generatorMeta): GeneratorInterface;

    public function getMeta(): GeneratorMetaInterface;

    public function getActorName(): string;
}
