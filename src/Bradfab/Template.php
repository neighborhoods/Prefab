<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab;

use Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository\Handler;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository\HandlerInterface;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryInterface;
use Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor;
use Neighborhoods\Prefab\Bradfab\Template\AwareTraitActor;
use Neighborhoods\Prefab\Bradfab\Template\BuilderActor;
use Neighborhoods\Prefab\Bradfab\Template\FactoryActor;
use Symfony\Component\Yaml\Yaml;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository;

class Template implements TemplateInterface
{
    protected const KEY_SUPPORTING_ACTORS = 'supporting_actors';
    protected const KEY_REPOSITORY = 'Map\Repository.php';
    protected const KEY_REPOSITORY_INTERFACE = 'Map\RepositoryInterface.php';
    protected const KEY_HANDLER_INTERFACE = 'Map\Repository\HandlerInterface.php';
    protected const KEY_HANDLER = 'Map\Repository\Handler.php';
    protected const KEY_HANDLER_SERVICE_FILE = 'Map\Repository\Handler.service.yml';
    protected const KEY_REPOSITORY_SERVICE_FILE = 'Map\Repository.service.yml';
    protected const KEY_BUILDER = 'Builder.php';
    protected const KEY_NAMESPACE_ANNOTATION_PROCESSOR = 'Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor';

    protected const KEY_ANNOTATION_PROCESSORS = 'annotation_processors';
    protected const KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME = 'processor_fqcn';
    protected const KEY_STATIC_CONTEXT_RECORD = 'static_context_record';

    protected const CONTEXT_KEY_ROUTE_PATH = 'route_path';
    protected const CONTEXT_KEY_ROUTE_NAME = 'route_name';
    protected const CONTEXT_KEY_NAMESPACES = 'namespaces';
    protected const CONTEXT_KEY_NAMESPACE = 'namespace';
    protected const CONTEXT_KEY_PROJECT_NAME = 'project_name';

    protected const SUPPORTING_ACTOR_GROUP_FULL = 'full';
    protected const SUPPORTING_ACTOR_GROUP_REDUCED = 'reduced';

    protected $supportingActorConfigFiles = [
        self::SUPPORTING_ACTOR_GROUP_FULL => 'AllSupportingActors.yml',
        self::SUPPORTING_ACTOR_GROUP_REDUCED => 'ReducedSupportingActors.yml'
    ];

    protected $route_path;
    protected $route_name;
    protected $properties;
    protected $project_name;
    protected $supporting_actor_group;
    protected $supporting_actors = [];

    public function getFabricationConfig() : array
    {
        return [self::KEY_SUPPORTING_ACTORS => $this->getSupportingActorsConfig()];
    }

    public function addAwareTraitActor() : TemplateInterface
    {
        $this->supporting_actors = array_merge($this->supporting_actors, (new AwareTraitActor())->getActorConfiguration());
        return $this;
    }

    public function addFactoryActor() : TemplateInterface
    {
        $this->supporting_actors = array_merge($this->supporting_actors, (new FactoryActor())->getActorConfiguration());
        return $this;
    }

    public function addBuilder() : TemplateInterface
    {
        $builderActor = new BuilderActor();
        if ($this->hasProperties()) {
            $builderActor->setProperties($this->getProperties());
        }

        $this->supporting_actors =
            array_merge($this->supporting_actors, $builderActor->getActorConfiguration());

        return $this;
    }

    public function addHandler() : TemplateInterface
    {
        $annotationProcessors = [];

        $namespaces = [
            'Http\Message' => 'use \Neighborhoods\PROJECTNAME\Prefab5\Psr\Http\Message\ServerRequest\AwareTrait;',
            'SearchCriteria' => 'use \Neighborhoods\PROJECTNAME\Prefab5\SearchCriteria\ServerRequest\Builder\Factory\AwareTrait;',
        ];

        foreach ($namespaces as $key => $namespace) {
            $annotationProcessors[Handler::ANNOTATION_PROCESSOR_KEY . '-' . $key] =
                $this->getNamespaceAnnotationProcessorArray($namespace);
        }

        $this->supporting_actors[self::KEY_HANDLER][self::KEY_ANNOTATION_PROCESSORS] = $annotationProcessors;
        return $this;
    }

    public function addHandlerServiceFile() : TemplateInterface
    {
        $namespace = '@Neighborhoods\PROJECTNAME\Prefab5\SearchCriteria\ServerRequest\Builder\FactoryInterface';

        $this->supporting_actors[self::KEY_HANDLER_SERVICE_FILE][self::KEY_ANNOTATION_PROCESSORS][self::KEY_NAMESPACE_ANNOTATION_PROCESSOR] =
            $this->getNamespaceAnnotationProcessorArray($namespace);

        return $this;
    }

    public function addRepositoryServiceFile() : TemplateInterface
    {
        $annotationProcessors = [];

        $namespaces = [
            'HttpMessage' => '@Neighborhoods\PROJECTNAME\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface',
            'SearchCriteria' => '@Neighborhoods\PROJECTNAME\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\FactoryInterface',
        ];

        foreach ($namespaces as $key => $namespace) {
            $annotationProcessors[NamespaceAnnotationProcessor::ANNOTATION_PROCESSOR_KEY . '-' . $key] =
                $this->getNamespaceAnnotationProcessorArray($namespace);
        }

        $this->supporting_actors[self::KEY_REPOSITORY_SERVICE_FILE][self::KEY_ANNOTATION_PROCESSORS] = $annotationProcessors;
        return $this;
    }

    public function addRepository() : TemplateInterface
    {
        $config = $this->getSupportingActorsConfig();

        $namespaces = [
            'Neighborhoods\PROJECTNAME\Prefab5\Doctrine',
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteriaInterface',
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteria',
        ];

        $this->supporting_actors[self::KEY_REPOSITORY] =
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

        $this->supporting_actors = $config;
        return $this;
    }

    public function addRepositoryInterface() : TemplateInterface
    {
        $config = $this->getSupportingActorsConfig();

        $namespaces = [
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteriaInterface',
        ];

        $this->supporting_actors[self::KEY_REPOSITORY_INTERFACE] =
            [
                self::KEY_ANNOTATION_PROCESSORS =>
                    [
                        RepositoryInterface::ANNOTATION_PROCESSOR_KEY => [
                            self::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . RepositoryInterface::class,
                            self::KEY_STATIC_CONTEXT_RECORD => [
                                self::CONTEXT_KEY_PROJECT_NAME => $this->getProjectName(),
                                self::CONTEXT_KEY_NAMESPACES => $namespaces,
                            ],
                        ],
                    ],
            ];

        $this->supporting_actors = $config;
        return $this;
    }

    public function addRepositoryHandlerInterface() : TemplateInterface
    {
        if ($this->hasRouteName() && $this->hasRoutePath()) {
            $this->supporting_actors[self::KEY_HANDLER_INTERFACE] =
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
        }

        return $this;
    }

    protected function getNamespaceAnnotationProcessorArray(string $namespace) : array
    {
        return
            [
                self::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . NamespaceAnnotationProcessor::class,
                self::KEY_STATIC_CONTEXT_RECORD =>
                    [
                        self::CONTEXT_KEY_PROJECT_NAME => $this->getProjectName(),
                        self::CONTEXT_KEY_NAMESPACE => $namespace,
                    ],
            ];
    }

    protected function getSupportingActorsConfig() : array
    {
        if ($this->supporting_actors === null) {
            $supportingActorGroup = $this->hasSupportingActorGroup()
                ? $this->getSupportingActorGroup()
                : self::SUPPORTING_ACTOR_GROUP_FULL;

            $supportingActorsConfigFile =
                $this->supportingActorConfigFiles[$supportingActorGroup] ??
                $this->supportingActorConfigFiles[self::SUPPORTING_ACTOR_GROUP_FULL];

            // Warn about provided group not being found?

            $this->supporting_actors = Yaml::parseFile(__DIR__ . '/' . $supportingActorsConfigFile);
        }

        return $this->supporting_actors;
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

    public function getSupportingActorGroup()
    {
        if ($this->supporting_actor_group === null) {
            throw new \LogicException('Template supporting_actor_group has not been set.');
        }
        return $this->supporting_actor_group;
    }

    public function setSupportingActorGroup(string $supporting_actor_group): TemplateInterface
    {
        if ($this->supporting_actor_group !== null) {
            throw new \LogicException('Template supporting_actor_group is already set.');
        }
        $this->supporting_actor_group = $supporting_actor_group;
        return $this;
    }

    public function hasSupportingActorGroup() : bool
    {
        return $this->supporting_actor_group !== null;
    }
}
