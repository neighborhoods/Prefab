<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

use Neighborhoods\Prefab\Console\GeneratorInterface;

class BuildPlan implements BuildPlanInterface
{
    protected $generators = [];

    public function execute() : BuildPlanInterface
    {
        foreach ($this->generators as $generator) {
            $generator->generate();
        }

        return $this;
    }

    public function appendGenerator(GeneratorInterface $generator) : BuildPlanInterface
    {
        $this->generators[] = $generator;
        return $this;
    }
}
