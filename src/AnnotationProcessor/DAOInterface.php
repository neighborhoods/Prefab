<?php

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class DAOInterface implements AnnotationProcessorInterface
{
    /** @var ContextInterface */
    private $context;

    private const PROP_CONSTANT_PATTERN = "public const PROP_%s = '%s';";

    public function setAnnotationProcessorContext(ContextInterface $Context)
    {
        if ($this->context !== null) {
            throw new \LogicException('DAOInterface Annotation Processor context is already set');
        }

        $this->context = $Context;
    }

    public function getAnnotationProcessorContext(): ContextInterface
    {
        if ($this->context === null) {
            throw new \LogicException('DAOInterface Annotation Processor context is not set');
        }

        return $this->context;
    }

    public function getReplacement(): string
    {
        $context = $this->getAnnotationProcessorContext()->getStaticContextRecord();

        $constants = [];
        $accessors = [];

        foreach($context as $field) {
            $name = $field['name'];
            $type = $field['type'];
            $recordKey = $field['record_key'];

            $constants[] = $this->buildConstant($name, $recordKey);
            $accessors[] = $this->buildAccessors($name, $type);
        }

        return
            implode($constants, PHP_EOL) .
            PHP_EOL . PHP_EOL .
            implode($accessors, PHP_EOL . PHP_EOL);
    }

    private function buildConstant(string $propertyName, string $recordKey) : string
    {
        $allUpperPropertyName = strtoupper($propertyName);

        return <<<EOC
    public const PROP_$allUpperPropertyName = '$recordKey';
EOC;
    }

    private function buildAccessors(string $propertyName, string $type): string
    {
        $pascalCaseName = $this->getPascalCaseName($propertyName);
        $interface = $this->getAnnotationProcessorContext()->getFabricationFile()->getFileName() . 'Interface';

        return <<<EOC
    public function get$pascalCaseName(): $type;
    public function set$pascalCaseName($type \$$propertyName): $interface;
    public function has$pascalCaseName(): bool;
EOC;
    }

    private function getPascalCaseName(string $propertyName) : string
    {
        $propertyArray = explode('_', $propertyName);

        $pascalCaseName = '';
        foreach ($propertyArray as $propertyPart) {
            $pascalCaseName .= ucfirst($propertyPart);
        }

        return $pascalCaseName;
    }
}
