<?php

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;

interface RouteMapBuilderInterface
{
    public function buildRouteMap() : array;

    public function setRouteFilePath(string $routeFilePath) : RouteMapBuilderInterface;

    public function setNamespace(string $namespace) : RouteMapBuilderInterface;
}
