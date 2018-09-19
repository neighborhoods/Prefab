<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

interface GeneratorInterface
{
    public function generate(): GeneratorInterface;

    public function setMeta(GeneratorMetaInterface $generatorMeta): GeneratorInterface;

}
