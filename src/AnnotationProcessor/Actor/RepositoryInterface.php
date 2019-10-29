<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class RepositoryInterface implements AnnotationProcessorInterface
{
    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryInterface-ProjectName';

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
        $projectName = $this->getAnnotationProcessorContext()->getStaticContextRecord()['project_name'];

        foreach ($this->getAnnotationProcessorContext()->getStaticContextRecord()['namespaces'] as $namespace) {
            $paths  .= 'use ' . str_replace('PROJECTNAME',  $projectName, $namespace) . ';' . PHP_EOL;
        }

        return $paths;
    }
}
