<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;


use Symfony\Component\Yaml\Yaml;

class RouteMapBuilder implements RouteMapBuilderInterface
{
    protected $routeFilePath;
    protected $namespace;

    protected const HTTP_REQUEST_TYPES = [
        'get',
        'post',
        'put',
        'delete'
    ];

    public function buildRouteMap() : array
    {
        $routeYaml = Yaml::parseFile($this->getRouteFilePath());

        $directoryMap = [];

        foreach (reset($routeYaml['services'])['calls'] as $methodCall)
        {
            $httpRequestType = $methodCall[0];

            if (in_array($httpRequestType, self::HTTP_REQUEST_TYPES)) {
                $serviceName = $methodCall[1][1];
                $directory = str_replace('@' . $this->getNamespace(), '', $serviceName);
                $directory = explode('\\', $directory)[0];

                if (!isset($directoryMap[$httpRequestType][$directory])) {
                    $directoryMap[$httpRequestType][$directory] = true;
                }
            }
        }

        return $directoryMap;
    }

    protected function getRouteFilePath() : string
    {
        if ($this->routeFilePath === null) {
            throw new \LogicException('RouteFileParser routeFilePath has not been set.');
        }
        return $this->routeFilePath;
    }

    public function setRouteFilePath(string $routeFilePath) : RouteMapBuilderInterface
    {
        if ($this->routeFilePath !== null) {
            throw new \LogicException('RouteFileParser routeFilePath is already set.');
        }
        $this->routeFilePath = $routeFilePath;
        return $this;
    }

    protected function getNamespace() : string
    {
        if ($this->namespace === null) {
            throw new \LogicException('RouteMapBuilder namespace has not been set.');
        }
        return $this->namespace;
    }

    public function setNamespace(string $namespace) : RouteMapBuilderInterface
    {
        if ($this->namespace !== null) {
            throw new \LogicException('RouteMapBuilder namespace is already set.');
        }
        $this->namespace = $namespace;
        return $this;
    }
}
