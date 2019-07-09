<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Bradfab\AnnotationProcessor\ContextInterface;
use Neighborhoods\Bradfab\AnnotationProcessorInterface;

class Builder implements AnnotationProcessorInterface
{
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder-build';

    protected const NEIGHBORHOODS_NAMESPACE = '\\Neighborhoods\\';
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
        $properties = $this->getAnnotationProcessorContext()->getStaticContextRecord()['properties'];

        $replacement = '';

        foreach ($properties as $propertyName => $property) {

            $camelCaseName = '';
            $nameArray = explode('_', $propertyName);
            foreach ($nameArray as $part) {
                $camelCaseName .= ucfirst($part);
            }

            if ($this->isPropertyComplexObject($property['data_type'])) {
                if (strpos($property['data_type'], 'MapInterface') !== false) {
                    $pattern = self::COMPLEX_OBJECT_MAP_BUILDER_METHOD;
                } else {
                    $pattern = self::COMPLEX_OBJECT_BUILDER_METHOD;
                }

                $method = sprintf(
                    $pattern,
                    $camelCaseName,
                    $this->getFullyQualifiedNameForType($property['data_type']),
                    strtoupper($propertyName)
                );

                if ($property['nullable'] === true) {
                    $method = sprintf(
                                self::NULLABLE_PROPERTY_METHOD_PATTERN,
                                strtoupper($propertyName),
                                trim($method)
                              );
                }

                $replacement .= $method . "\n";
            } else {

                if ($property['data_type'] === 'float') {
                    $typeCast = '(float)';
                } else {
                    $typeCast = '';
                }

                $method = sprintf(self::NON_COMPLEX_OBJECT_METHOD_PATTERN, $camelCaseName, $typeCast, strtoupper($propertyName));

                if ($property['nullable'] === true) {
                    $replacement .= sprintf(
                        self::NULLABLE_PROPERTY_METHOD_PATTERN,
                        strtoupper($propertyName),
                        trim($method)
                    );
                } else {
                    $replacement .= '   ' . $method . "\n";
                }
            }
        }

        return $replacement;
    }

    protected function isPropertyComplexObject(string $type) : bool
    {
        return strpos($type, self::NEIGHBORHOODS_NAMESPACE) === 0;
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
