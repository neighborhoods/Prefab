<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class BuilderFactoryTrait implements AnnotationProcessorInterface
{
    const STATIC_CONTEXT_RECORD_KEY_DATA_TYPE = 'data_type';
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder-AwareTraits';

    public const STATIC_CONTEXT_RECORD_KEY_VENDOR = 'vendor';

    public const STATIC_CONTEXT_RECORD_KEY_PROPERTIES = 'properties';
    public const ACTOR_PROPERTY_KEY_NULLABLE = 'nullable';
    public const ACTOR_PROPERTY_KEY_DATA_TYPE = 'data_type';
    public const ACTOR_PROPERTY_KEY_CREATED_ON_INSERT = 'created_on_insert';

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
        $properties = $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::STATIC_CONTEXT_RECORD_KEY_PROPERTIES];

        $replacement = '';

        $builtTraits = [];
        foreach ($properties as $propertyName => $property) {
            if (
                $this->isPropertyComplexObject($property[self::STATIC_CONTEXT_RECORD_KEY_DATA_TYPE])
                && !in_array($property[self::STATIC_CONTEXT_RECORD_KEY_DATA_TYPE], $builtTraits)
            ) {
                $dataType = str_replace('Interface', '', $property[self::STATIC_CONTEXT_RECORD_KEY_DATA_TYPE]);
                $replacement .= "\tuse " . $dataType . '\\Builder\\Factory\\AwareTrait;' . PHP_EOL;
                $builtTraits[] = $property[self::STATIC_CONTEXT_RECORD_KEY_DATA_TYPE];
            }
        }

        return $replacement;
    }

    protected function isPropertyComplexObject(string $type) : bool
    {
        return strpos($type,  '\\' . $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::STATIC_CONTEXT_RECORD_KEY_VENDOR]) === 0;
    }
}
