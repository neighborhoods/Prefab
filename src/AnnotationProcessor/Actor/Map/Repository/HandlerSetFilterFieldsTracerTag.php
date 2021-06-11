<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class HandlerSetFilterFieldsTracerTag implements AnnotationProcessorInterface
{
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\Handler-setFilterFieldsTracerTag';

    public const STATIC_CONTEXT_RECORD_KEY_TAG_FILTER_FIELDS = 'tag_filter_fields_on_tracer';

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
        if (isset($record[self::STATIC_CONTEXT_RECORD_KEY_TAG_FILTER_FIELDS]) && $record[self::STATIC_CONTEXT_RECORD_KEY_TAG_FILTER_FIELDS]) {
            $replacement = <<< EOF
    private function setFilterFieldsTracerTag(Prefab5\SearchCriteriaInterface $searchCriteria): void {

        $filterFields = [];
        foreach ($searchCriteria->getFilters() as $filter) {
            $filterFields[] = $filter->getField();
        }

        if (!empty($filterFields)) {
            ksort($filterFields);
        }

        $tracer = $this->getGlobalTracerRepository()->get();
        $span = $tracer->getActiveSpan();

        if ($span !== null) {
            $span->setTag('filter_fields', implode('-', $filterFields));
        }
    }

EOF;
        }

        return $replacement;
    }
}