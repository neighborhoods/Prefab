<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryInterface;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryJsonColumns;
use Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor;
use Neighborhoods\Prefab\Bradfab\Template;

class RepositoryActor implements RepositoryActorInterface
{
    use AwareTraitActor\Factory\AwareTrait;

    protected $project_name;
    protected $properties;

    public function getActorConfiguration() : array
    {
        $config =
            [
                self::REPOSITORY_ACTOR_KEY => $this->getRepositoryActor(),
                self::REPOSITORY_INTERFACE_ACTOR_KEY => $this->getRepositoryInterfaceActor(),
                self::REPOSITORY_SERVICE_FILE_ACTOR_KEY => $this->getRepositoryServiceFileActor(),
                self::REPOSITORY_KEY . '\\' . AwareTraitActor::ACTOR_KEY =>
                    $this->getAwareTraitActorFactory()->create()
                        ->getActorConfiguration()[AwareTraitActor::ACTOR_KEY],
            ];

        return $config;
    }

    protected function getRepositoryActor() : ?array
    {
        $namespaces = [
            'Neighborhoods\PROJECTNAME\Prefab5\Doctrine',
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteriaInterface',
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteria',
        ];
        
        $propertyArray = json_decode(json_encode($this->getProperties()), true);
        var_export($propertyArray);
        return [
            Template::KEY_ANNOTATION_PROCESSORS =>
                [
                    Repository::ANNOTATION_PROCESSOR_KEY => [
                        Template::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . Repository::class,
                        Template::KEY_STATIC_CONTEXT_RECORD => [
                            Repository::KEY_PROJECT_NAME => $this->getProjectName(),
                            Repository::KEY_NAMESPACES => $namespaces,
                        ],
                    ],
                    RepositoryJsonColumns::ANNOTATION_PROCESSOR_KEY => [
                        Template::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . RepositoryJsonColumns::class,
                        Template::KEY_STATIC_CONTEXT_RECORD => [
                            RepositoryJsonColumns::KEY_PROJECT_NAME => $this->getProjectName(),
                            RepositoryJsonColumns::KEY_PROPERTIES => $propertyArray,
                        ],
                    ],
                ],
        ];
    }

    protected function getRepositoryInterfaceActor() : array
    {
        $namespaces = [
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteriaInterface',
        ];

        return [
            Template::KEY_ANNOTATION_PROCESSORS =>
                [
                    RepositoryInterface::ANNOTATION_PROCESSOR_KEY => [
                        Template::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . RepositoryInterface::class,
                        Template::KEY_STATIC_CONTEXT_RECORD => [
                            Template::CONTEXT_KEY_PROJECT_NAME => $this->getProjectName(),
                            Template::CONTEXT_KEY_NAMESPACES => $namespaces,
                        ],
                    ],
                ],
        ];
    }

    protected function getRepositoryServiceFileActor() : ?array
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

        return [Template::KEY_ANNOTATION_PROCESSORS => $annotationProcessors];
    }

    protected function getProjectName() : string
    {
        if ($this->project_name === null) {
            throw new \LogicException('RepositoryActor project_name has not been set.');
        }
        return $this->project_name;
    }

    public function setProjectName($project_name) : RepositoryActorInterface
    {
        if ($this->project_name !== null) {
            throw new \LogicException('RepositoryActor project_name is already set.');
        }
        $this->project_name = $project_name;
        return $this;
    }


    protected function getProperties() : array
    {
        if ($this->properties === null) {
            throw new \LogicException('RepositoryActor properties has not been set.');
        }
        return $this->properties;
    }

    public function setProperties(array $properties) : RepositoryActorInterface
    {
        if ($this->properties !== null) {
            throw new \LogicException('RepositoryActor properties is already set.');
        }
        $this->properties = $properties;
        return $this;
    }

    protected function getNamespaceAnnotationProcessorArray(string $namespace) : array
    {
        return
            [
                Template::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . NamespaceAnnotationProcessor::class,
                Template::KEY_STATIC_CONTEXT_RECORD =>
                    [
                        Template::CONTEXT_KEY_PROJECT_NAME => $this->getProjectName(),
                        Template::CONTEXT_KEY_NAMESPACE => $namespace,
                    ],
            ];
    }

}
