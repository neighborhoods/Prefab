<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\DAOInterface;

use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\StringReplacer;

class Generator implements GeneratorInterface
{
    use ClassSaver\Factory\AwareTrait;
    use StringReplacer\Factory\AwareTrait;

    protected const TABLE_NAME_PLACEHOLDER = 'TABLENAMEPLACEHOLDER';
    protected const IDENTITY_FIELD = 'FIELDIDENTITYPLACEHOLDER';
    protected const DATABASE_PROPERTIES_PLACEHOLDER = 'DATABASEPROPERTIESPLACEHOLDER';
    protected const METHODS_PLACEHOLDER = 'METHODSPLACEHOLDER';
    protected const DATABASE_CONSTANTS_PLACEHOLDER = 'DATABASEPROPERTIESPLACEHOLDER';
    protected const DAO_NAME_PLACEHOLDER = 'DAONAMEPLACEHOLDER';

    protected const GET_METHOD_PATTERN = 'public function get%s(): %s;';
    protected const SET_METHOD_PATTERN = 'public function set%s(%s $%s): %sInterface;';
    protected const HAS_METHOD_PATTERN = 'protected function has%s(): bool';
    protected const DATABASE_CONSTANT_PATTERN = "public const PROP_%s = '%s';";

    protected $namespace;
    protected $generator;
    protected $classSaver;
    protected $meta;


    public function generate() : GeneratorInterface
    {
        $file = file_get_contents(__DIR__ . '/Template.php');
        $builtFile = $this->replaceEntityPlaceholders($file);

        $this->getClassSaverFactory()->create()
            ->setClassName($this->getActorName())
            ->setGeneratedClass($builtFile)
            ->setSavePath($this->getMeta()->getActorFilePath())
            ->saveClass();

        return $this;
    }

    protected function replaceEntityPlaceholders(string $fileContent) : string
    {
        $fileContent = str_replace(self::DAO_NAME_PLACEHOLDER, $this->getMeta()->getDaoName(), $fileContent);
        $fileContent = str_replace(self::TABLE_NAME_PLACEHOLDER, $this->getMeta()->getTableName(), $fileContent);
        $fileContent = str_replace(self::IDENTITY_FIELD, $this->getMeta()->getDaoIdentityField(), $fileContent);
        $fileContent = str_replace(self::METHODS_PLACEHOLDER, $this->getClassMethodsString(), $fileContent);
        $fileContent = str_replace(self::DATABASE_PROPERTIES_PLACEHOLDER, $this->getDatabaseConstantsString(), $fileContent);

        return $this->getStringReplacerFactory()
            ->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
            ->setFile($fileContent)
            ->replacePlaceholders();
    }

    protected function getDatabaseConstantsString() : string
    {
        $constantsString = '';

        foreach ($this->getMeta()->getDaoProperties() as $property => $values) {
            $constantsString .= sprintf("\t" . self::DATABASE_CONSTANT_PATTERN, strtoupper($property), $values['database_column_name']) . "\n";
        }

        return $constantsString;
    }

    protected function getClassMethodsString() : string
    {
        $methodString = '';

        foreach ($this->getMeta()->getDaoProperties() as $property => $values) {
            $camelCaseProperty = '';
            $propertyArray = explode('_', $property);

            foreach ($propertyArray as $part) {
                $camelCaseProperty .= ucfirst($part);
            }

            $methodString .= sprintf("\t" . self::GET_METHOD_PATTERN, $camelCaseProperty, $values['php_type']) . "\n";
            $methodString .= sprintf("\t" . self::SET_METHOD_PATTERN, $camelCaseProperty, $values['php_type'], $property, $this->getMeta()->getDaoName()) . "\n";
        }

        return $methodString;
    }

    public function getMeta() : GeneratorMetaInterface
    {
        if ($this->meta === null) {
            throw new \LogicException('Generator meta has not been set.');
        }
        return $this->meta;
    }

    public function setMeta(GeneratorMetaInterface $meta) : GeneratorInterface
    {
        if ($this->meta !== null) {
            throw new \LogicException('Generator meta is already set.');
        }
        $this->meta = $meta;
        return $this;
    }

    public function getActorName(): string
    {
        return $this->getMeta()->getDaoName() . 'Interface';
    }
}
