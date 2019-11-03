<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class Repository implements AnnotationProcessorInterface
{
    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-ProjectName';

    public const KEY_NAMESPACES = 'namespaces';
    public const KEY_PROJECT_NAME = 'project_name';

    protected $context;

    public function getAnnotationProcessorContext() : ContextInterface
    {
        if ($this->context === null) {
            throw new \LogicException('Handler context has not been set.');
        }
        return $this->context;
    }

    public function setAnnotationProcessorContext(ContextInterface $context) : AnnotationProcessorInterface
    {
        if ($this->context !== null) {
            throw new \LogicException('Handler context is already set.');
        }
        $this->context = $context;
        return $this;
    }

    public function getReplacement() : string
    {
        $paths = '';
        $projectName = $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::KEY_PROJECT_NAME];

        foreach ($this->getAnnotationProcessorContext()->getStaticContextRecord()[self::KEY_NAMESPACES] as $namespace) {
            $paths  .= 'use ' . str_replace('PROJECTNAME',  $projectName, $namespace) . ';' . PHP_EOL;
        }

        return $paths;
    }
}
