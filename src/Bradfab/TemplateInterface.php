<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab;

interface TemplateInterface
{
    public function getFabricationConfig() : array;

    public function addAwareTraitActor() : TemplateInterface;

    public function addFactoryActor() : TemplateInterface;

    public function addBuilder() : TemplateInterface;

    public function addMap() : TemplateInterface;

    public function addHandler() : TemplateInterface;

    public function addRepository() : TemplateInterface;

    public function setRoutePath(string $route_path) : TemplateInterface;

    public function setRouteName(string $route_name) : TemplateInterface;

    public function setProperties(array $properties) : TemplateInterface;

    public function setProjectName(string $project_name) : TemplateInterface;

    public function setIdentityField(string $identity_field) : TemplateInterface;
}
