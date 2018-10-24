<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;


use Neighborhoods\Prefab\Console\GeneratorInterface;

interface BuildPlanInterface
{
    public function execute() : BuildPlanInterface;
    public function appendGenerator(GeneratorInterface $generator) : BuildPlanInterface;
}
