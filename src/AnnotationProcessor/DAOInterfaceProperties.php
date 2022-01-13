<?php

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class DAOInterfaceProperties implements AnnotationProcessorInterface
{
    public const STATIC_CONTEXT_RECORD_KEY_PROPERTIES = 'properties';
    public const STATIC_CONTEXT_RECORD_KEY_CONSTANTS = 'constants';

    /** @var ContextInterface */
    private $context;

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

        if (isset($context[self::STATIC_CONTEXT_RECORD_KEY_CONSTANTS])) {
            foreach ($context[self::STATIC_CONTEXT_RECORD_KEY_CONSTANTS] as $constant) {
                $constants[] = $this->buildUserDefinedConstant($constant['name'], $constant['value']);
            }
        }

        foreach ($context[self::STATIC_CONTEXT_RECORD_KEY_PROPERTIES] as $field) {
            $name = $field['name'];
            $type = $field['type'];
            $recordKey = $field['record_key'];
            $deprecated = ($field['deprecated'] ?? false) ? $field['deprecated_message'] : null;

            $constants[] = $this->buildPropertyConstant($name, $recordKey, $deprecated);
            $accessors[] = $this->buildAccessors($name, $type, $deprecated);
        }

        return
            implode(PHP_EOL, $constants) .
            PHP_EOL . PHP_EOL .
            implode(PHP_EOL . PHP_EOL, $accessors);
    }

    private function buildUserDefinedConstant(string $name, $value) : string
    {
        if (is_array($value)) {
            $valueString = $this->convertArrayToStringValue($value);
        } else {
            $valueString = var_export($value, true);
        }

        return "    public const $name = $valueString;";
    }

    private function convertArrayToStringValue(array $values)
    {
        $arrayItems = [];

        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $valueToAppendToArray = $this->convertArrayToStringValue($value);
            } else {
                $valueToAppendToArray = var_export($value, true);
            }

            if (is_numeric($key)) {
                $arrayItems[] = $valueToAppendToArray;
            } else {
                $arrayItems[] = var_export($key, true) . ' => ' . $valueToAppendToArray;
            }
        }

        return '[ ' . implode(', ', $arrayItems) . ']';
    }

    private function buildPropertyConstant(string $propertyName, string $recordKey, ?string $deprecated) : string
    {
        $allUpperPropertyName = strtoupper($propertyName);
        $deprecatedTag = $deprecated !== null ? "/** @deprecated $deprecated */" . PHP_EOL . '    ' : '';

        return <<<EOC
    {$deprecatedTag}public const PROP_$allUpperPropertyName = '$recordKey';
EOC;
    }

    private function buildAccessors(string $propertyName, string $type, ?string $deprecated): string
    {
        $pascalCaseName = $this->getPascalCaseName($propertyName);
        $interface = $this->getAnnotationProcessorContext()->getFabricationFile()->getFileName() . 'Interface';
        $deprecatedTag = $deprecated !== null ? "/** @deprecated $deprecated */" . PHP_EOL . '    ' : '';

        return <<<EOC
    {$deprecatedTag}public function get$pascalCaseName(): $type;
    {$deprecatedTag}public function set$pascalCaseName($type \$$propertyName): $interface;
    {$deprecatedTag}public function has$pascalCaseName(): bool;
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
