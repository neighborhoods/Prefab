<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Actor;

use Neighborhoods\Bradfab\AnnotationProcessor\ContextInterface;
use Neighborhoods\Bradfab\AnnotationProcessorInterface;

class Builder implements AnnotationProcessorInterface
{
    protected $context;

    protected const NULLABLE_PROPERTY_METHOD_PATTERN =

"
    if (isset(\$record[ActorInterface::PROP_%s])) {\n
        \$actor->set%s(\$record[ActorInterface::PROP_%s]);\n
    }\n\n
";

    protected const NON_NULLABLE_PROPERTY_METHOD_PATTERN = "   \$actor->set%s(\$record[ActorInterface::PROP_%s]);\n\n";

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

            if ($property['nullable'] === true) {
                $replacement .= sprintf(
                    self::NULLABLE_PROPERTY_METHOD_PATTERN,
                    strtoupper($propertyName),
                    ucfirst($propertyName),
                    strtoupper($propertyName)
                );
            } else {
                $replacement =
            }
        }

        return sprintf(self::ROUTE_PATH_LINE_FORMAT_STRING, $name, $path, $name, $name);
    }
}
