<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class BuilderBuildForInsertMethod implements AnnotationProcessorInterface
{
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder-buildForInsert';
    public const STATIC_CONTEXT_RECORD_KEY_VENDOR = 'vendor';

    public const STATIC_CONTEXT_RECORD_KEY_PROPERTIES = 'properties';
    public const ACTOR_PROPERTY_KEY_NULLABLE = 'nullable';
    public const ACTOR_PROPERTY_KEY_DATA_TYPE = 'data_type';
    public const ACTOR_PROPERTY_KEY_CREATED_ON_INSERT = 'created_on_insert';

    protected const COMPLEX_OBJECT_BUILDER_METHOD = <<< EOF
        \$Actor->set%s(
            \$this->get%sBuilderFactory()->create()->setRecord(\$record[ActorInterface::PROP_%s])->build()
        );
EOF;

    protected const COMPLEX_OBJECT_MAP_BUILDER_METHOD = <<< EOF
        \$Actor->set%s(
            \$this->get%sBuilderFactory()->create()->setRecords(\$record[ActorInterface::PROP_%s])->build()
        );
EOF;
    protected const NON_COMPLEX_OBJECT_METHOD_PATTERN =
        "\t\t\$Actor->set%s(%s\$record[ActorInterface::PROP_%s]);";

    protected const NULLABLE_PROPERTY_METHOD_PATTERN = <<< EOF
        if (isset(\$record[ActorInterface::PROP_%s])) {
            %s
        }

EOF;

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

        foreach ($properties as $propertyName => $property) {

            if ($this->isPropertyComplexObject($property[self::ACTOR_PROPERTY_KEY_DATA_TYPE])) {
                $replacement .= $this->getSetterForComplexObject($property, $propertyName);
            } else {
                $replacement .= $this->getSetterForNonComplexObject($property, $propertyName);
            }
        }

        return $replacement;
    }

    protected function isPropertyComplexObject(string $type) : bool
    {
        return strpos($type,  '\\' . $this->getAnnotationProcessorContext()->getStaticContextRecord()[self::STATIC_CONTEXT_RECORD_KEY_VENDOR]) === 0;
    }

    /**
     *  Converts a fully qualified actor name into its camel case variable name
     *  Example: \Neighborhoods\SomeService\MV1\NoahInterface -> MV1Noah
     */
    protected function getFullyQualifiedNameForType(string $property) : string
    {
        // Example: \Neighborhoods\SomeService\MV1\Actor
        $property = str_replace('Interface', '', $property);
        $propertyArray = explode('\\', $property);

        // $propertyArray[0] will be an empty string due to leading \
        // Unset Neighborhoods
        unset($propertyArray[1]);
        // Unset Service Name
        unset($propertyArray[2]);

        return implode('', $propertyArray);
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

    protected function getSetterForComplexObject(array $property, string $propertyName) : string
    {
        if (strpos($property[self::ACTOR_PROPERTY_KEY_DATA_TYPE], 'MapInterface') !== false) {
            $pattern = self::COMPLEX_OBJECT_MAP_BUILDER_METHOD;
        } else {
            $pattern = self::COMPLEX_OBJECT_BUILDER_METHOD;
        }

        $method = sprintf(
            $pattern,
            $this->getCamelCasePropertyName($propertyName),
            $this->getFullyQualifiedNameForType($property[self::ACTOR_PROPERTY_KEY_DATA_TYPE]),
            strtoupper($propertyName)
        );

        if ($property[self::ACTOR_PROPERTY_KEY_NULLABLE] === true || $property[self::ACTOR_PROPERTY_KEY_CREATED_ON_INSERT] === true) {
            $method = sprintf(
                self::NULLABLE_PROPERTY_METHOD_PATTERN,
                strtoupper($propertyName),
                trim($method)
            );
        }

        return $method . "\n";
    }

    protected function getSetterForNonComplexObject(array $property, string $propertyName) : string
    {
        if ($property[self::ACTOR_PROPERTY_KEY_DATA_TYPE] === 'float') {
            $typeCast = '(float)';
        } else {
            $typeCast = '';
        }

        $method = sprintf(
            self::NON_COMPLEX_OBJECT_METHOD_PATTERN,
            $this->getCamelCasePropertyName($propertyName),
            $typeCast,
            strtoupper($propertyName)
        );

        if ($property[self::ACTOR_PROPERTY_KEY_NULLABLE] === true || self::ACTOR_PROPERTY_KEY_CREATED_ON_INSERT === true) {
            return sprintf(
                self::NULLABLE_PROPERTY_METHOD_PATTERN,
                strtoupper($propertyName),
                trim($method)
            );
        } else {
            return '   ' . $method . "\n";
        }
    }
}
