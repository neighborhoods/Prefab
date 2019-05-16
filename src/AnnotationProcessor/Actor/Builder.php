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

    protected const NEIGHBORHOODS_NAMESPACE = 'Neighborhoods\\';

    protected const COMPLEX_OBJECT_BUILDER_METHOD =
"
            \$this->getMV5PropertyInteriorFeaturesBuilderFactory()
                ->create()
                ->setRecord(\$record)
                ->build();
";
    protected const NULLABLE_PROPERTY_METHOD_PATTERN =
"
        if (isset(\$record[ActorInterface::PROP_%s])) {
            \$Actor->set%s(\$record[ActorInterface::PROP_%s]);
        }\n
";

    protected const NON_NULLABLE_PROPERTY_METHOD_PATTERN =
"        \$Actor->set%s(\$record[ActorInterface::PROP_%s]);\n";

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

            if ($this->isPropertyComplexObject($property['database_column_name']))
            {
//                $method =
            }

            $camelCaseName = '';
            $nameArray = explode('_', $propertyName);
            foreach ($nameArray as $part) {
                $camelCaseName .= ucfirst($part);
            }

            if ($property['nullable'] === true) {
                $replacement .= sprintf(
                    self::NULLABLE_PROPERTY_METHOD_PATTERN,
                    strtoupper($propertyName),
                    $camelCaseName,
                    strtoupper($propertyName)
                );
            } else {
                $replacement .= sprintf(
                    self::NON_NULLABLE_PROPERTY_METHOD_PATTERN,
                    $camelCaseName,
                    strtoupper($propertyName)
                );
            }
        }

        return $replacement;
    }

    protected function isPropertyComplexObject(string $type) : bool
    {
        return strpos($type, self::NEIGHBORHOODS_NAMESPACE) === 0;
    }
}
