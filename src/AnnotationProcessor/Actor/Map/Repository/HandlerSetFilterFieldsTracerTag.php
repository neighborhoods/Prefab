<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class HandlerSetFilterFieldsTracerTag implements AnnotationProcessorInterface, HandlerInterface
{
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\Handler-setFilterFieldsTracerTag';

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
            $replacement = <<<'EOT'
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

EOT;
        }

        return $replacement;
    }
}