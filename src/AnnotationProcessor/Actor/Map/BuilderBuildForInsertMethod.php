<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor\Map;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class BuilderBuildForInsertMethod implements AnnotationProcessorInterface
{
    protected const IDENTITY_FIELD_TERNARY_METHOD_PATTERN = '$item->has%s() ? $item->get%s() : $index';
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Builder-identity-field-ternary';
    public const CONTEXT_KEY_IDENTITY_FIELD = 'identity_field';

    public function getAnnotationProcessorContext() : ContextInterface
    {
        if ($this->context === null) {
            throw new \LogicException('BuilderBuildForInsertMethod context has not been set.');
        }
        return $this->context;
    }

    public function setAnnotationProcessorContext(ContextInterface $context) : AnnotationProcessorInterface
    {
        if ($this->context !== null) {
            throw new \LogicException('BuilderBuildForInsertMethod context is already set.');
        }
        $this->context = $context;
        return $this;
    }

    public function getReplacement() : string
    {
        $camelCaseName = '';
        $nameArray = explode('_', $this->getAnnotationProcessorContext()->getStaticContextRecord()['identity_field']);
        foreach ($nameArray as $part) {
            $camelCaseName .= ucfirst($part);
        }

        return sprintf(self::IDENTITY_FIELD_TERNARY_METHOD_PATTERN, $camelCaseName, $camelCaseName);
    }
}
