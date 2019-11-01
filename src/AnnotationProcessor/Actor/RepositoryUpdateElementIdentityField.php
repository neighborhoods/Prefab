<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class RepositoryUpdateElementIdentityField implements AnnotationProcessorInterface
{
    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-updateElementIdentityField';

    public const KEY_IDENTITY_FIELD = 'identity_field';

    protected const WHERE_CLAUSE_IDENTITY_FIELD_PATTERN = <<< EOF
        ActorInterface::PROP_%s, \$Actor->get%s()
EOF;

    protected $context;

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
        $identityField = $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::KEY_IDENTITY_FIELD];

        $camelCasePropertyName = $this->getCamelCasePropertyName($identityField);

        $replacementWhereClause = sprintf(
            self::WHERE_CLAUSE_IDENTITY_FIELD_PATTERN,
            strtoupper($identityField),
            $camelCasePropertyName
        );

        return $replacementWhereClause;
    }

    protected function getCamelCasePropertyName(string $propertyName) : string
    {
        $camelCaseName = '';
        $nameArray = explode('_', $propertyName);
        foreach ($nameArray as $part) {
            $camelCaseName .= ucfirst($part);
        }
        return $camelCaseName;
    }
}
