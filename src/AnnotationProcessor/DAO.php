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

        foreach($context as $field) {
            $name = $field['name'];
            $type = $field['type'];

            $properties[] = $this->buildProperty($name, $type);
            $accessors[] = $this->buildAccessors($name, $type);
        }

        return implode($properties, PHP_EOL . PHP_EOL) . PHP_EOL . PHP_EOL . implode($accessors, PHP_EOL . PHP_EOL);
    }

    private function buildProperty(string $name, string $type): string
    {
        return <<<EOC
    /** @var $type */
    private \$$name;
EOC;

    }

    private function buildAccessors($name, $type): string
    {
        $upperName = ucfirst($name);
        $interface = $this->getAnnotationProcessorContext()->getFabricationFile()->getFileName() . 'Interface';

        return <<<EOC
     public function get$upperName(): $type
     {
         if (\$this->$name === null) {
             throw new \LogicException('$name has not been set');
         }
         
         return \$this->$name;
     }
     
     public function set$upperName($type \$$name): $interface
     {
         if (\$this->$name !== null) {
             throw new \LogicException('$name has already been set');
         }
         
         \$this->$name = \$$name;
         
         return \$this;
     }
EOC;
    }
}
