<?php

namespace Neighborhoods\Prefab;

interface GeneratorInterface
{
    public function generate();

    public function setProjectName(string $projectName) : GeneratorInterface;

    public function setProjectRoot(string $projectDir) : GeneratorInterface;

    public function setHttpSrcDir(string $httpSrcDir) : GeneratorInterface;

    public function setSrcLocation(string $srcLocation) : GeneratorInterface;

    public function setFabricator(FabricatorInterface $fabricator) : GeneratorInterface;
}
