<?php

namespace Neighborhoods\Prefab;

interface GeneratorInterface
{
    public function generate();

    public function getProjectName() : string;

    public function setProjectName(string $projectName) : GeneratorInterface;

    public function getBuildPlans() : array;

    public function appendBuildPlan(BuildPlanInterface $buildPlan) : GeneratorInterface;
}
