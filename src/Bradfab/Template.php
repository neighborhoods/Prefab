<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab;

use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository\HandlerInterface;
use Symfony\Component\Yaml\Yaml;

class Template implements TemplateInterface
{
    protected const KEY_SUPPORTING_ACTORS = 'supporting_actors';
    protected const KEY_HANDLER_INTERFACE = 'Repository\HandlerInterface.php';
    protected const KEY_ANNOTATION_PROCESSORS = 'annotation_processors';
    protected const KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME = 'processor_fqcn';
    protected const KEY_STATIC_CONTEXT_RECORD = 'static_context_record';

    protected const CONTEXT_KEY_ROUTE_PATH = 'route_path';
    protected const CONTEXT_KEY_ROUTE_NAME = 'route_name';

    protected $route_path;
    protected $route_name;
    protected $properties;

    protected $all_supporting_actors;

    public function getFabricationConfig() : array
    {
        $this->configureRepositoryHandlerInterface();
        return $this->getAllSupportingActorsConfig();
    }

    protected function configureRepositoryHandlerInterface() : TemplateInterface
    {
        if ($this->hasRouteName() && $this->hasRoutePath()) {
            $config = $this->getAllSupportingActorsConfig();
            $config[self::KEY_SUPPORTING_ACTORS][self::KEY_HANDLER_INTERFACE] =
                [
                    self::KEY_ANNOTATION_PROCESSORS =>
                        [
                            HandlerInterface::ANNOTATION_PROCESSOR_KEY => [
                                self::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . HandlerInterface::class,
                                self::KEY_STATIC_CONTEXT_RECORD => [
                                    self::CONTEXT_KEY_ROUTE_PATH => $this->getRoutePath(),
                                    self::CONTEXT_KEY_ROUTE_NAME => $this->getRouteName(),
                                ],
                            ],
                        ],
                ];
            $this->all_supporting_actors = $config;
        }

        return $this;
    }


    protected function getAllSupportingActorsConfig() : array
    {
        if ($this->all_supporting_actors === null) {
            $this->all_supporting_actors = Yaml::parseFile(__DIR__ . '/AllSupportingActors.yml');
        }

        return $this->all_supporting_actors;
    }

    public function getRoutePath() : string
    {
        if ($this->route_path === null) {
            throw new \LogicException('Template route_path has not been set.');
        }
        return $this->route_path;
    }

    public function setRoutePath(string $route_path) : TemplateInterface
    {
        if ($this->route_path !== null) {
            throw new \LogicException('Template route_path is already set.');
        }
        $this->route_path = $route_path;
        return $this;
    }

    public function hasRoutePath() : bool
    {
        return $this->route_path !== null;
    }

    protected function getRouteName() : string
    {
        if ($this->route_name === null) {
            throw new \LogicException('Template route_name has not been set.');
        }
        return $this->route_name;
    }

    public function setRouteName(string $route_name) : TemplateInterface
    {
        if ($this->route_name !== null) {
            throw new \LogicException('Template route_name is already set.');
        }
        $this->route_name = $route_name;
        return $this;
    }

    public function hasRouteName() : bool
    {
        return $this->route_name !== null;
    }

    protected function getProperties() : array
    {
        if ($this->properties === null) {
            throw new \LogicException('Template properties has not been set.');
        }
        return $this->properties;
    }

    public function setProperties(array $properties) : TemplateInterface
    {
        if ($this->properties !== null) {
            throw new \LogicException('Template properties is already set.');
        }
        $this->properties = $properties;
        return $this;
    }

    public function hasProperties() : bool
    {
        return $this->properties !== null;
    }
}
