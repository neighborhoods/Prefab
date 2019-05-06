<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository\Handler;
use Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository\HandlerInterface;
use Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor;
use Neighborhoods\Prefab\Bradfab\Template;

class HandlerActor
{
    public const HANDLER_KEY = 'Map\Repository\Handler';

    public const HANDLER_ACTOR_KEY = 'Map\Repository\Handler.php';
    public const HANDLER_INTERFACE_ACTOR_KEY = 'Map\Repository\HandlerInterface.php';
    public const HANDLER_SERVICE_FILE_ACTOR_KEY = 'Map\Repository\Handler.service.yml';

    protected $project_name;

    public function getActorConfiguration() : array
    {
        $config =
            [
                self::HANDLER_ACTOR_KEY => $this->getHandlerActor(),
                self::HANDLER_INTERFACE_ACTOR_KEY => $this->getHandlerInterfaceActor(),
                self::HANDLER_SERVICE_FILE_ACTOR_KEY => $this->getHandlerServiceFileActor(),
                self::HANDLER_KEY . '\\' . AwareTraitActor::ACTOR_KEY => (new AwareTraitActor())->getActorConfiguration()[AwareTraitActor::ACTOR_KEY],
            ];

        return $config;
    }

    protected function getHandlerActor() : ?array
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

        return [Template::KEY_ANNOTATION_PROCESSORS => $annotationProcessors];
    }

    protected function getHandlerInterfaceActor() : array
    {
        $namespaces = [
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteriaInterface',
        ];

        return [
            Template::KEY_ANNOTATION_PROCESSORS =>
                [
                    HandlerInterface::ANNOTATION_PROCESSOR_KEY => [
                        Template::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . HandlerInterface::class,
                        Template::KEY_STATIC_CONTEXT_RECORD => [
                            Template::CONTEXT_KEY_PROJECT_NAME => $this->getProjectName(),
                            Template::CONTEXT_KEY_NAMESPACES => $namespaces,
                        ],
                    ],
                ],
        ];
    }

    protected function getHandlerServiceFileActor() : ?array
    {

        $namespace = '@Neighborhoods\PROJECTNAME\Prefab5\SearchCriteria\ServerRequest\Builder\FactoryInterface';

        return
            [
                Template::KEY_ANNOTATION_PROCESSORS =>
                    [
                        NamespaceAnnotationProcessor::ANNOTATION_PROCESSOR_KEY => $this->getNamespaceAnnotationProcessorArray($namespace),
                    ],
            ];

    }

    public function getProjectName()
    {
        if ($this->project_name === null) {
            throw new \LogicException('HandlerActor project_name has not been set.');
        }
        return $this->project_name;
    }

    public function setProjectName($project_name)
    {
        if ($this->project_name !== null) {
            throw new \LogicException('HandlerActor project_name is already set.');
        }
        $this->project_name = $project_name;
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
