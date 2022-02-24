<?php

declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Buphalo\V1\AnnotationProcessor\ContextInterface;
use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;

class DAO implements AnnotationProcessorInterface
{
    /** @var ContextInterface */
    private $context;

    public function setAnnotationProcessorContext(ContextInterface $Context): void
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

            $isDeprecated = $field['is_deprecated'] ?? false;
            $deprecatedMessage = $field['deprecated_message'] ?? null;
            $replacement = $field['replacement'] ?? null;
            $this->validateDeprecation($isDeprecated, $deprecatedMessage, $replacement);

            $properties[] = $this->buildProperty($name, $type);
            $accessors[] = $this->buildAccessors($name, $type, $isDeprecated, $deprecatedMessage, $replacement);
        }

        return implode(PHP_EOL . PHP_EOL, $properties) . PHP_EOL . PHP_EOL . implode(PHP_EOL . PHP_EOL, $accessors);
    }

    private function validateDeprecation(bool $isDeprecated, ?string $deprecatedMessage, ?string $replacement): void
    {
        if (!$isDeprecated) {
            if ($deprecatedMessage !== null) {
                throw new \UnexpectedValueException(
                    "deprecated_message '$deprecatedMessage' is set for a non-deprecated property"
                );
            }
            if ($replacement !== null) {
                throw new \UnexpectedValueException(
                    "replacement '$replacement' is set for a non-deprecated property"
                );
            }
        }
    }

    private function buildProperty(string $name, string $type): string
    {
        return <<<EOC
    /** @var $type */
    private \$$name;
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
    {$getterDeprecatedTag}public function get$pascalCaseName(): $type
    {
        if (\$this->$propertyName === null) {
            throw new \LogicException('$propertyName has not been set');
        }
        
        return \$this->$propertyName;
    }
    
    {$setterDeprecatedTag}public function set$pascalCaseName($type \$$propertyName): $interface
    {
        if (\$this->$propertyName !== null) {
            throw new \LogicException('$propertyName has already been set');
        }
        
        \$this->$propertyName = \$$propertyName;
        return \$this;
    }
    
    {$hasserDeprecatedTag}public function has$pascalCaseName(): bool
    {
        return \$this->$propertyName !== null;
    }
     
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
