<?php


namespace Neighborhoods\Prefab\BuildConfiguration;


use Neighborhoods\Prefab\BuildConfigurationInterface;

interface BuilderInterface
{
    public function build() : BuildConfigurationInterface;
    public function setYamlFilePath(string $yamlFilePath) : BuilderInterface;
    public function setProjectName(string $projectName) : BuilderInterface;
    public function setProjectRoot(string $projectRoot) : BuilderInterface;
    public function setVendorName(string $vendorName) : BuilderInterface;
}
