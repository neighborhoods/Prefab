<?php

namespace Neighborhoods\Prefab;

interface GeneratorInterface
{
    public function generate();

    public function setProjectName(string $projectName) : GeneratorInterface;

    public function setProjectRoot(string $projectDir) : GeneratorInterface;

    public function appendBuildPlan(BuildPlanInterface $buildPlan) : GeneratorInterface;

    public function setHttpSrcDir(string $httpSrcDir) : GeneratorInterface;

    public function setStagedHttpDir(string $stagedHttpDir) : GeneratorInterface;

    public function setFabLocation(string $fabLocation) : GeneratorInterface;

    public function setSrcLocation(string $srcLocation) : GeneratorInterface;
}
