<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class MapInterfaceJsonSerializable implements AnnotationProcessorInterface
{
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\MapInterface-JsonSerializable';

    public const STATIC_CONTEXT_RECORD_KEY_SERIALIZES_AS_ARRAY = 'json_serialize_map_as_array';

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
        if (isset($record[self::STATIC_CONTEXT_RECORD_KEY_SERIALIZES_AS_ARRAY]) && $record[self::STATIC_CONTEXT_RECORD_KEY_SERIALIZES_AS_ARRAY]) {
            $replacement = ', \\JsonSerializable';
        }
        return $replacement;
    }
}
