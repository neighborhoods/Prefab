<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor\Map;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class Builder implements AnnotationProcessorInterface
{
    protected const GET_IDENTITY_FIELD_METHOD_PATTERN = '$map[$item->get%s()]';
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Builder-identity-field';
    public const CONTEXT_KEY_IDENTITY_FIELD = 'identity_field';

    public function getAnnotationProcessorContext() : ContextInterface
    {
        if ($this->context === null) {
            throw new \LogicException('Builder context has not been set.');
        }
        return $this->context;
    }

    public function setAnnotationProcessorContext(ContextInterface $context) : AnnotationProcessorInterface
    {
        if ($this->context !== null) {
            throw new \LogicException('Builder context is already set.');
        }
        $this->context = $context;
        return $this;
    }

    public function getReplacement() : string
    {
        $camelCaseName = '';
        $nameArray = explode('_', $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::CONTEXT_KEY_IDENTITY_FIELD]);
        foreach ($nameArray as $part) {
            $camelCaseName .= ucfirst($part);
        }

        return sprintf(self::GET_IDENTITY_FIELD_METHOD_PATTERN, $camelCaseName);
    }
}
