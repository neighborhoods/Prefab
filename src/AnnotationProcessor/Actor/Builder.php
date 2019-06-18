<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Bradfab\AnnotationProcessor\ContextInterface;
use Neighborhoods\Bradfab\AnnotationProcessorInterface;
use Neighborhoods\Prefab\BuildConfigurationInterface;

class Builder implements AnnotationProcessorInterface
{
    protected $context;

    public const ANNOTATION_PROCESSOR_KEY = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder-build';

    protected const NEIGHBORHOODS_NAMESPACE = '\\Neighborhoods\\';

    protected const COMPLEX_OBJECT_BUILDER_METHOD = <<< EOF
    \$Actor->set%s(
            \$this->get%sBuilderFactory()->create()->setRecord(\$record['%s'])->build();
        );
EOF;

    protected const NON_COMPLEX_OBJECT_METHOD_PATTERN =
"\$Actor->set%s(\$record[ActorInterface::PROP_%s]);";

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

            if ($this->isPropertyComplexObject($property['php_type'])) {
                $method = sprintf(
                    self::COMPLEX_OBJECT_BUILDER_METHOD,
                    $camelCaseName,
                    $this->getFullyQualifiedNameForType($property['php_type']),
                    $property['database_column_name']
                );

                if ($property['nullable'] === true) {
                    $method = sprintf(
                                self::NULLABLE_PROPERTY_METHOD_PATTERN,
                                strtoupper($propertyName),
                                $method
                              );
                }

                $replacement .= $method . "\n";
            } else {
                $method = sprintf(self::NON_COMPLEX_OBJECT_METHOD_PATTERN, $camelCaseName, strtoupper($propertyName));

                if ($property['nullable'] === true) {
                    $replacement .= sprintf(
                        self::NULLABLE_PROPERTY_METHOD_PATTERN,
                        strtoupper($propertyName),
                        "\t" . $method
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

    protected function getFullyQualifiedNameForType(string $property) : string
    {
        $property = str_replace('Interface', '', $property);
        $propertyArray = explode('\\', $property);

        // $propertyArray[0] will be an empty string due to the leading \
        // Unset Neighborhoods
        unset($propertyArray[1]);
        // Unset Service Name
        unset($propertyArray[2]);

        return implode('', $propertyArray);
    }
}
