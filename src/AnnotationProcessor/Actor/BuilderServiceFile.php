<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class BuilderServiceFile implements AnnotationProcessorInterface
{
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\BuilderServiceFile';

    public const STATIC_CONTEXT_RECORD_KEY_VENDOR = 'vendor';
    public const STATIC_CONTEXT_RECORD_KEY_PROPERTIES = 'properties';

    public const ACTOR_PROPERTY_KEY_DATA_TYPE = 'data_type';

    protected const BUILDER_FACTORY_SET_METHOD_PATTERN =
"      - [set%sBuilderFactory, ['@%s\Builder\FactoryInterface']]\n";

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
        $builtDataTypes = [];
        foreach ($properties as $propertyName => $property) {
            $propertyType = $property[self::ACTOR_PROPERTY_KEY_DATA_TYPE];
            if ($this->isPropertyComplexObject($propertyType) && !in_array($propertyType, $builtDataTypes)) {
                $builtDataTypes[] = $propertyType;
                $fullyQualifiedName = $this->getFullyQualifiedNameForType($propertyType);

                $dataType = ltrim($property[self::ACTOR_PROPERTY_KEY_DATA_TYPE], '\\');
                $dataType = str_replace('Interface', '', $dataType);

                $replacement .= sprintf(
                    self::BUILDER_FACTORY_SET_METHOD_PATTERN,
                    $fullyQualifiedName,
                    $dataType
                ) . PHP_EOL;
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
}
