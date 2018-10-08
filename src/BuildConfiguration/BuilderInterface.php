<?php


namespace Neighborhoods\Prefab\BuildConfiguration;


use Neighborhoods\Prefab\BuildConfigurationInterface;

interface BuilderInterface
{
    public function build() : BuildConfigurationInterface;
    public function setYamlFilePath(string $yamlFilePath) : BuilderInterface;
}
