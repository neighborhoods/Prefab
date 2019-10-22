<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Bradfab\AnnotationProcessor\ContextInterface;
use Neighborhoods\Bradfab\AnnotationProcessorInterface;

class RepositoryJsonColumns implements AnnotationProcessorInterface
{
    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-JsonColumns';

    public const KEY_PROPERTIES = 'properties';

    protected const NEIGHBORHOODS_NAMESPACE = '\\Neighborhoods\\';
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

        foreach ($this->getAnnotationProcessorContext()->getStaticContextRecord()[self::KEY_PROPERTIES] as $property) {
            if ($this->isPropertyJsonField($property['data_type'])) {
                $replacement .= sprintf(self::JSON_COLUMN_ARRAY_ITEM_PATTERN, strtoupper($property['name']));
            }
        }

        return $replacement;
    }

    protected function isPropertyJsonField(string $type) : bool
    {
        return ($type === 'array') || (strpos($type, self::NEIGHBORHOODS_NAMESPACE) === 0);
    }
}
