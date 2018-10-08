<?php


namespace Neighborhoods\Prefab\BuildConfiguration;


use Neighborhoods\Prefab\BuildConfiguration;

interface BuilderInterface
{
    public function build() : BuildConfiguration;
    public function setYamlFilePath(string $yamlFilePath) : BuilderInterface;
}
