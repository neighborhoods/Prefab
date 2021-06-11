<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class HandlerCallSetFilterFieldsTracerTag implements AnnotationProcessorInterface
{
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\Handler-callSetFilterFieldsTracerTag';

    public const STATIC_CONTEXT_RECORD_KEY_TAG_FILTER_FIELDS_ON_TRACER = 'tag_filter_fields_on_tracer';

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
        $replacement = '';

        $record = $this->getAnnotationProcessorContext()->getStaticContextRecord();
        if (isset($record[self::STATIC_CONTEXT_RECORD_KEY_TAG_FILTER_FIELDS_ON_TRACER]) && $record[self::STATIC_CONTEXT_RECORD_KEY_TAG_FILTER_FIELDS_ON_TRACER]) {
            $replacement = <<< EOF
            $this->setFilterFieldsTracerTag($searchCriteria);
EOF;
        }

        return $replacement;
    }
}