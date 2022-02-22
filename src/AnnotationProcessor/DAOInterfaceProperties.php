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

            $isDeprecated = $field['is_deprecated'] ?? isset($field['deprecated_message']) || isset($field['replacement']);
            $deprecatedMessage = $field['deprecated_message'] ?? null;
            $replacement = $field['replacement'] ?? null;

            $constants[] = $this->buildPropertyConstant(
                $name,
                $recordKey,
                $isDeprecated,
                $deprecatedMessage,
                $replacement
            );
            $accessors[] = $this->buildAccessors($name, $type, $isDeprecated, $deprecatedMessage, $replacement);
        }

        return
            implode(PHP_EOL, $constants) .
            PHP_EOL . PHP_EOL .
            implode(PHP_EOL . PHP_EOL, $accessors);
    }

    private function buildUserDefinedConstant(string $name, $value): string
    {
        if (\is_array($value)) {
            $valueString = $this->convertArrayToStringValue($value);
        } else {
            $valueString = var_export($value, true);
        }

        return "    public const $name = $valueString;";
    }

    private function convertArrayToStringValue(array $values): string
    {
        $arrayItems = [];

        foreach ($values as $key => $value) {
            if (\is_array($value)) {
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

    private function buildPropertyConstant(
        string $propertyName,
        string $recordKey,
        bool $isDeprecated,
        ?string $deprecatedMessage,
        ?string $replacement
    ): string {
        $allUpperPropertyName = strtoupper($propertyName);
        $deprecatedTag = $isDeprecated ? $this->buildDeprecatedTag('const', $deprecatedMessage, $replacement) : '';

        return <<<EOC
    {$deprecatedTag}public const PROP_$allUpperPropertyName = '$recordKey';
EOC;
    }

    private function buildAccessors(
        string $propertyName,
        string $type,
        bool $isDeprecated,
        ?string $deprecatedMessage,
        ?string $replacement
    ): string {
        $pascalCaseName = $this->getPascalCaseName($propertyName);
        $interface = $this->getAnnotationProcessorContext()->getFabricationFile()->getFileName() . 'Interface';
        $getterDeprecatedTag = $isDeprecated ? $this->buildDeprecatedTag('get', $deprecatedMessage, $replacement) : '';
        $setterDeprecatedTag = $isDeprecated ? $this->buildDeprecatedTag('set', $deprecatedMessage, $replacement) : '';
        $hasserDeprecatedTag = $isDeprecated ? $this->buildDeprecatedTag('has', $deprecatedMessage, $replacement) : '';

        return <<<EOC
    {$getterDeprecatedTag}public function get$pascalCaseName(): $type;
    {$setterDeprecatedTag}public function set$pascalCaseName($type \$$propertyName): $interface;
    {$hasserDeprecatedTag}public function has$pascalCaseName(): bool;
EOC;
    }

    /** @link https://blog.jetbrains.com/phpstorm/2020/10/phpstorm-2020-3-eap-4/#deprecated */
    private function buildDeprecatedTag(string $method, ?string $message, ?string $replacement): string
    {
        $params = [];
        if ($message) {
            $params[] = sprintf('reason: \'%s\'', addslashes($message));
        }

        if ($replacement) {
            $params[] = sprintf('replacement: \'%s\'', $this->buildReplacement($method, $replacement));
        }

        return sprintf('#[Deprecated(%s)]', implode(', ', $params)) . PHP_EOL . '    ';
    }

    private function buildReplacement(string $method, string $field): string
    {
        $pascalCaseName = $this->getPascalCaseName($field);
        switch ($method) {
            case 'get':
            case 'has':
                return "%class%->{$method}{$pascalCaseName}()";
            case 'set':
                return "%class%->{$method}{$pascalCaseName}(%parameter0%)";
            case 'const':
                return "%class%::PROP_" . strtoupper($field);
            default:
                throw new \UnexpectedValueException("Unexpected method $method");
        }
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
