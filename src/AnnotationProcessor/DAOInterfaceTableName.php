<?php

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class DAOInterfaceTableName implements AnnotationProcessorInterface
{
    /** @var ContextInterface */
    private $context;

    public const ANNOTATION_PROCESSOR_KEY_TABLE_NAME = 'table_name';

    public function setAnnotationProcessorContext(ContextInterface $Context)
    {
        if ($this->context !== null) {
            throw new \LogicException('DAOInterface Annotation Processor context is already set');
        }

        $this->context = $Context;
    }

    public function getAnnotationProcessorContext(): ContextInterface
    {
        if ($this->context === null) {
            throw new \LogicException('DAOInterface Annotation Processor context is not set');
        }

        return $this->context;
    }

    public function getReplacement(): string
    {
        $context = $this->getAnnotationProcessorContext()->getStaticContextRecord();

        $tableName = $context[self::ANNOTATION_PROCESSOR_KEY_TABLE_NAME];

        return "    public const TABLE_NAME = '$tableName';";

    }
}
