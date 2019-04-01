<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab;

use Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository\Handler;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository\HandlerInterface;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryInterface;
use Symfony\Component\Yaml\Yaml;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository;

class Template implements TemplateInterface
{
    protected const KEY_SUPPORTING_ACTORS = 'supporting_actors';
    protected const KEY_REPOSITORY = 'Repository.php';
    protected const KEY_REPOSITORY_INTERFACE = 'RepositoryInterface.php';
    protected const KEY_HANDLER_INTERFACE = 'Repository\HandlerInterface.php';
    protected const KEY_HANDLER = 'Repository\Handler.php';
    protected const KEY_BUILDER = 'Builder.php';

    protected const KEY_ANNOTATION_PROCESSORS = 'annotation_processors';
    protected const KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME = 'processor_fqcn';
    protected const KEY_STATIC_CONTEXT_RECORD = 'static_context_record';

    protected const CONTEXT_KEY_ROUTE_PATH = 'route_path';
    protected const CONTEXT_KEY_ROUTE_NAME = 'route_name';
    protected const CONTEXT_KEY_PROPERTIES = 'properties';
    protected const CONTEXT_KEY_NAMESPACES = 'namespaces';
    protected const CONTEXT_KEY_PROJECT_NAME = 'project_name';

    protected $route_path;
    protected $route_name;
    protected $properties;
    protected $project_name;

    protected $all_supporting_actors;

    public function getFabricationConfig() : array
    {
        $this->configureHandler();
        $this->configureRepositoryHandlerInterface();
        $this->configureRepository();
        $this->configureRepositoryInterface();
        $this->configureBuilder();

        return $this->getAllSupportingActorsConfig();
    }

    protected function configureBuilder() : TemplateInterface
    {
        $config = $this->getAllSupportingActorsConfig();
        $propertyArray = [];

        foreach ($this->getProperties() as $propertyName => $propertyValues) {
            $propertyArray[$propertyName] = [
                'nullable' => $propertyValues['nullable'] ?? false,
            ];
        }

        $config[self::KEY_SUPPORTING_ACTORS][self::KEY_BUILDER] =
            [
                self::KEY_ANNOTATION_PROCESSORS =>
                    [
                        Builder::ANNOTATION_PROCESSOR_KEY  => [
                            self::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . Builder::class,
                            self::KEY_STATIC_CONTEXT_RECORD => [
                                self::CONTEXT_KEY_PROPERTIES => $propertyArray
                            ]
                        ]
                    ]
            ];

        $this->all_supporting_actors = $config;
        return $this;
    }

    protected function configureHandler() : TemplateInterface
    {
        $config = $this->getAllSupportingActorsConfig();

        $namespaces = [
            '\Neighborhoods\PROJECTNAME\Prefab5\Psr\Http\Message\ServerRequest\AwareTrait',
            '\Neighborhoods\PROJECTNAME\Prefab5\SearchCriteria\ServerRequest\Builder\Factory\AwareTrait'
        ];
        $config[self::KEY_SUPPORTING_ACTORS][self::KEY_HANDLER] =
            [
                self::KEY_ANNOTATION_PROCESSORS =>
                    [
                        Handler::ANNOTATION_PROCESSOR_KEY  => [
                            self::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . Repository\Handler::class,
                            self::KEY_STATIC_CONTEXT_RECORD => [
                                self::CONTEXT_KEY_PROJECT_NAME => $this->getProjectName(),
                                self::CONTEXT_KEY_NAMESPACES => $namespaces,
                            ]
                        ]
                    ]
            ];

        $this->all_supporting_actors = $config;
        return $this;
    }

    protected function configureRepository() : TemplateInterface
    {
        $config = $this->getAllSupportingActorsConfig();

        $namespaces = [
            'Neighborhoods\PROJECTNAME\Prefab5\Doctrine',
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteriaInterface',
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteria',
        ];

        $config[self::KEY_SUPPORTING_ACTORS][self::KEY_REPOSITORY] =
            [
                self::KEY_ANNOTATION_PROCESSORS =>
                    [
                        Repository::ANNOTATION_PROCESSOR_KEY  => [
                            self::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . Repository::class,
                            self::KEY_STATIC_CONTEXT_RECORD => [
                                self::CONTEXT_KEY_PROJECT_NAME => $this->getProjectName(),
                                self::CONTEXT_KEY_NAMESPACES => $namespaces,
                            ]
                        ]
                    ]
            ];

        $this->all_supporting_actors = $config;
        return $this;
    }

    protected function configureRepositoryInterface() : TemplateInterface
    {
        $config = $this->getAllSupportingActorsConfig();

        $namespaces = [
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteriaInterface',
        ];

        $config[self::KEY_SUPPORTING_ACTORS][self::KEY_REPOSITORY_INTERFACE] =
            [
                self::KEY_ANNOTATION_PROCESSORS =>
                    [
                        RepositoryInterface::ANNOTATION_PROCESSOR_KEY  => [
                            self::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . RepositoryInterface::class,
                            self::KEY_STATIC_CONTEXT_RECORD => [
                                self::CONTEXT_KEY_PROJECT_NAME => $this->getProjectName(),
                                self::CONTEXT_KEY_NAMESPACES => $namespaces,
                            ]
                        ]
                    ]
            ];

        $this->all_supporting_actors = $config;
        return $this;
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

    protected function getProjectName() : string
    {
        if ($this->project_name === null) {
            throw new \LogicException('Template project_name has not been set.');
        }
        return $this->project_name;
    }

    public function setProjectName(string $project_name) : TemplateInterface
    {
        if ($this->project_name !== null) {
            throw new \LogicException('Template project_name is already set.');
        }
        $this->project_name = $project_name;
        return $this;
    }
}