<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Bradfab\AnnotationProcessor\ContextInterface;
use Neighborhoods\Bradfab\AnnotationProcessorInterface;

class RepositoryUpdateElementMethod implements AnnotationProcessorInterface
{
    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-updateElement';

    public const KEY_PROPERTIES = 'properties';

    protected const NEIGHBORHOODS_NAMESPACE = '\\Neighborhoods\\';

    protected const CREATE_NAMED_PARAMETER_SIMPLE_PROPERTY_PATTERN = <<< EOF
     \$values[ActorInterface::PROP_%s] = 
            \$queryBuilder->createNamedParameter(\$Actor->get%s());
EOF;

    protected const CREATE_NAMED_PARAMETER_COMPLEX_PROPERTY_PATTERN = <<< EOF
     \$values[ActorInterface::PROP_%s] = 
            \$queryBuilder->createNamedParameter(json_encode(\$Actor->get%s()));
EOF;

    protected const NULLABLE_PROPERTY_CONDITION_PATTERN = <<< EOF
     
        if (\$Actor->has%s()) {
            %s
        }
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
        $properties = $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::KEY_PROPERTIES];

        $replacement = '';

        foreach ($properties as $property) {
            $propertyName = $property['name'];
            $camelCasePropertyName = $this->getCamelCasePropertyName($propertyName);

            $method = sprintf(
                $this->isPropertyComplexObject($property['data_type']) ?
                    self::CREATE_NAMED_PARAMETER_COMPLEX_PROPERTY_PATTERN :
                    self::CREATE_NAMED_PARAMETER_SIMPLE_PROPERTY_PATTERN,
                strtoupper($propertyName),
                $camelCasePropertyName
            );

            if ($property['nullable'] === true) {
                $method = sprintf(
                    self::NULLABLE_PROPERTY_CONDITION_PATTERN,
                    $camelCasePropertyName,
                    trim($method)
                );
            }

            $replacement .= '   ' . $method . PHP_EOL;
        }

        return $replacement;
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

    protected function isPropertyComplexObject(string $type) : bool
    {
        return strpos($type, self::NEIGHBORHOODS_NAMESPACE) === 0;
    }
}
