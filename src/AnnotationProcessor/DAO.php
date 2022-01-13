<?php

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class DAO implements AnnotationProcessorInterface
{
    /** @var ContextInterface */
    private $context;

    public function setAnnotationProcessorContext(ContextInterface $Context)
    {
        if ($this->context !== null) {
            throw new \LogicException('DAO Annotation Processor context is already set');
        }

        $this->context = $Context;
    }

    public function getAnnotationProcessorContext(): ContextInterface
    {
        if ($this->context === null) {
            throw new \LogicException('DAO Annotation Processor context is not set');
        }

        return $this->context;
    }

    public function getReplacement(): string
    {
        $context = $this->getAnnotationProcessorContext()->getStaticContextRecord();

        $properties = [];
        $accessors = [];

        foreach ($context as $field) {
            $name = $field['name'];
            $type = $field['type'];
            $deprecated = ($field['deprecated'] ?? false) ? $field['deprecated_message'] : null;

            $properties[] = $this->buildProperty($name, $type);
            $accessors[] = $this->buildAccessors($name, $type, $deprecated);
        }

        return implode(PHP_EOL . PHP_EOL, $properties) . PHP_EOL . PHP_EOL . implode(PHP_EOL . PHP_EOL, $accessors);
    }

    private function buildProperty(string $name, string $type): string
    {
        return <<<EOC
    /** @var $type */
    private \$$name;
EOC;

    }

    private function buildAccessors(string $propertyName, string $type, ?string $deprecated): string
    {
        $pascalCaseName = $this->getPascalCaseName($propertyName);
        $interface = $this->getAnnotationProcessorContext()->getFabricationFile()->getFileName() . 'Interface';
        $deprecatedTag = $deprecated !== null ? "/** @deprecated $deprecated */" . PHP_EOL . '     ' : '';

        return <<<EOC
     {$deprecatedTag}public function get$pascalCaseName(): $type
     {
         if (\$this->$propertyName === null) {
             throw new \LogicException('$propertyName has not been set');
         }
         
         return \$this->$propertyName;
     }
     
     {$deprecatedTag}public function set$pascalCaseName($type \$$propertyName): $interface
     {
         if (\$this->$propertyName !== null) {
             throw new \LogicException('$propertyName has already been set');
         }
         
         \$this->$propertyName = \$$propertyName;
         return \$this;
     }
     
     {$deprecatedTag}public function has$pascalCaseName(): bool
     {
        return \$this->$propertyName !== null;
     }
     
EOC;
    }

    private function getPascalCaseName(string $propertyName): string
    {
        $propertyArray = explode('_', $propertyName);

        $pascalCaseName = '';
        foreach ($propertyArray as $propertyPart) {
            $pascalCaseName .= ucfirst($propertyPart);
        }

        return $pascalCaseName;
    }
}
