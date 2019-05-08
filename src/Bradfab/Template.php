<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab;

use Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor;
use Neighborhoods\Prefab\Bradfab\Template\AwareTraitActor;
use Neighborhoods\Prefab\Bradfab\Template\BuilderActor;
use Neighborhoods\Prefab\Bradfab\Template\FactoryActor;
use Neighborhoods\Prefab\Bradfab\Template\HandlerActor;
use Neighborhoods\Prefab\Bradfab\Template\MapActor;
use Neighborhoods\Prefab\Bradfab\Template\MapBuilderActor;
use Neighborhoods\Prefab\Bradfab\Template\RepositoryActor;
use Symfony\Component\Yaml\Yaml;

class Template implements TemplateInterface
{
    use AwareTraitActor\Factory\AwareTrait;
    use BuilderActor\Factory\AwareTrait;
    use FactoryActor\Factory\AwareTrait;
    use HandlerActor\Factory\AwareTrait;
    use MapActor\Factory\AwareTrait;
    use MapBuilderActor\Factory\AwareTrait;
    use RepositoryActor\Factory\AwareTrait;

    protected const KEY_SUPPORTING_ACTORS = 'supporting_actors';
    protected const KEY_REPOSITORY = 'Map\Repository.php';
    protected const KEY_REPOSITORY_INTERFACE = 'Map\RepositoryInterface.php';
    protected const KEY_HANDLER_INTERFACE = 'Map\Repository\HandlerInterface.php';
    protected const KEY_HANDLER = 'Map\Repository\Handler.php';
    protected const KEY_HANDLER_SERVICE_FILE = 'Map\Repository\Handler.service.yml';
    protected const KEY_BUILDER = 'Builder.php';
    protected const KEY_NAMESPACE_ANNOTATION_PROCESSOR = 'Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor';

    public const KEY_ANNOTATION_PROCESSORS = 'annotation_processors';
    public const KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME = 'processor_fqcn';
    public const KEY_STATIC_CONTEXT_RECORD = 'static_context_record';

    protected const CONTEXT_KEY_ROUTE_PATH = 'route_path';
    protected const CONTEXT_KEY_ROUTE_NAME = 'route_name';

    public const CONTEXT_KEY_NAMESPACES = 'namespaces';
    public const CONTEXT_KEY_NAMESPACE = 'namespace';
    public const CONTEXT_KEY_PROJECT_NAME = 'project_name';

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
    protected $supporting_actors = [];

    public function getFabricationConfig() : array
    {
        return [self::KEY_SUPPORTING_ACTORS => $this->supporting_actors];
    }

    public function addAwareTraitActor() : TemplateInterface
    {
        $this->supporting_actors = array_merge(
            $this->supporting_actors,
            $this->getAwareTraitActorFactory()->create()->getActorConfiguration()
        );
        return $this;
    }

    public function addFactoryActor() : TemplateInterface
    {
        $this->supporting_actors = array_merge(
            $this->supporting_actors,
            $this->getFactoryActorFactory()->create()->getActorConfiguration()
        );
        return $this;
    }

    public function addBuilder() : TemplateInterface
    {
        $builderActor = $this->getBuilderActorFactory()->create();
        if ($this->hasProperties()) {
            $builderActor->setProperties($this->getProperties());
        }

        $this->supporting_actors =
            array_merge($this->supporting_actors, $builderActor->getActorConfiguration());

        return $this;
    }

    public function addMap() : TemplateInterface
    {
        $map = $this->getMapActorFactory()->create();

        $this->supporting_actors = array_merge($this->supporting_actors, $map->getActorConfiguration());

        return $this;
    }
    public function addHandler() : TemplateInterface
    {
        $handler = $this->getHandlerActorFactory()->create();

        if ($this->hasRoutePath()) {
            $handler->setRoutePath($this->getRoutePath())
                ->setRouteName($this->getRouteName());
        }

        $this->supporting_actors = array_merge(
            $this->supporting_actors,
            $handler->setProjectName($this->getProjectName())->getActorConfiguration()
        );

        return $this;
    }


    public function addRepository() : TemplateInterface
    {
        $repository = $this->getRepositoryActorFactory()->create();

        $this->supporting_actors = array_merge(
            $this->supporting_actors,
            $repository->setProjectName($this->getProjectName())->getActorConfiguration()
        );

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

    protected function getRoutePath() : string
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

    protected function hasRoutePath() : bool
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

    protected function hasRouteName() : bool
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

    protected function hasProperties() : bool
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
