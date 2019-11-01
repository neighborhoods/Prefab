<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class RepositoryJsonColumns implements AnnotationProcessorInterface
{
    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-JsonColumns';

    public const STATIC_CONTEXT_RECORD_KEY_PROPERTIES = 'properties';
    public const STATIC_CONTEXT_RECORD_KEY_VENDOR = 'vendor';

    public const ACTOR_PROPERTY_KEY_DATA_TYPE = 'data_type';
    public const ACTOR_PROPERTY_KEY_NAME = 'name';

    protected const JSON_COLUMN_ARRAY_ITEM_PATTERN = "\t\tActorInterface::PROP_%s,\n";

    protected $context;

    public function getAnnotationProcessorContext() : ContextInterface
    {
        if ($this->context === null) {
            throw new \LogicException('RepositoryJsonColumns context has not been set.');
        }
        return $this->context;
    }

    public function setAnnotationProcessorContext(ContextInterface $context) : AnnotationProcessorInterface
    {
        if ($this->context !== null) {
            throw new \LogicException('RepositoryJsonColumns context is already set.');
        }
        $this->context = $context;
        return $this;
    }

    public function getReplacement() : string
    {
        $replacement = '';

        foreach ($this->getAnnotationProcessorContext()->getStaticContextRecord()[self::STATIC_CONTEXT_RECORD_KEY_PROPERTIES] as $property) {
            if ($this->isPropertyJsonField($property[self::ACTOR_PROPERTY_KEY_DATA_TYPE])) {
                $replacement .= sprintf(self::JSON_COLUMN_ARRAY_ITEM_PATTERN, strtoupper($property[self::ACTOR_PROPERTY_KEY_NAME]));
            }
        }

        return $replacement;
    }

    protected function isPropertyJsonField(string $type) : bool
    {
        return ($type === 'array')
            || strpos($type, '\\' . $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::STATIC_CONTEXT_RECORD_KEY_VENDOR]) === 0;
    }
}
