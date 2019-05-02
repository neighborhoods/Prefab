<?php

namespace Neighborhoods\Prefab\Bradfab;

interface TemplateInterface
{
    public function getFabricationConfig() : array;

    public function setRoutePath(string $route_path) : TemplateInterface;

    public function hasRoutePath() : bool;

    public function setRouteName(string $route_name) : TemplateInterface;

    public function hasRouteName() : bool;

    public function setProperties(array $properties) : TemplateInterface;

    public function hasProperties() : bool;

    public function setProjectName(string $project_name) : TemplateInterface;

    public function setSupportingActorGroup(string $supporting_actor_group) : TemplateInterface;

    public function hasSupportingActorGroup() : bool;
}
