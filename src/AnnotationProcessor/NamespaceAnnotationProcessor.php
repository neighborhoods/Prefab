<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class NamespaceAnnotationProcessor implements AnnotationProcessorInterface
{
    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor';

    protected $context;

    public function getAnnotationProcessorContext() : ContextInterface
    {
        if ($this->context === null) {
            throw new \LogicException('NamespaceAnnotationProcessor context has not been set.');
        }
        return $this->context;
    }

    public function setAnnotationProcessorContext(ContextInterface $context) : AnnotationProcessorInterface
    {
        if ($this->context !== null) {
            throw new \LogicException('NamespaceAnnotationProcessor context is already set.');
        }
        $this->context = $context;
        return $this;
    }

    public function getReplacement() : string
    {
        $projectName = $this->getAnnotationProcessorContext()->getStaticContextRecord()['project_name'];
        $namespace = $this->getAnnotationProcessorContext()->getStaticContextRecord()['namespace'];

        return  str_replace('PROJECTNAME',  $projectName, $namespace);
    }
}
