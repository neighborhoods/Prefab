<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\DAO;

use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\StringReplacer;
use Symfony\Component\Yaml\Yaml;

class Generator implements GeneratorInterface
{
    use ClassSaver\Factory\AwareTrait;
    use StringReplacer\Factory\AwareTrait;

    protected const CLASS_PROPERTIES_PLACEHOLDER = 'CLASSPROPERTIESPLACEHOLDER';
    protected const METHODS_PLACEHOLDER = 'METHODSPLACEHOLDER';
    protected const DAO_NAME_PLACEHOLDER = 'DAONAMEPLACEHOLDER';
    protected const CAMEL_CASE_PROPERTYNAME_PLACEHOLDER = 'CAMELCASEPROPERTYNAMEPLACEHOLDER';
    protected const PROPERTY_TYPE_PLACEHOLDER = 'PROPERTYTYPEPLACEHOLDER';
    protected const PROPERTY_NAME_PLACEHOLDER = 'PROPERTYNAMEPLACEHOLDER';

    protected const GET_METHOD_PATTERN = <<<EOF
    public function getCAMELCASEPROPERTYNAMEPLACEHOLDER() : PROPERTYTYPEPLACEHOLDER
    {
        if (\$this->PROPERTYNAMEPLACEHOLDER === null) {
            throw new \LogicException('DAONAMEPLACEHOLDER PROPERTYNAMEPLACEHOLDER has not been set.');
        }
        return \$this->PROPERTYNAMEPLACEHOLDER;
    }
    
EOF;
    protected const SET_METHOD_PATTERN = <<<EOF
    public function setCAMELCASEPROPERTYNAMEPLACEHOLDER(PROPERTYTYPEPLACEHOLDER \$PROPERTYNAMEPLACEHOLDER) : DAONAMEPLACEHOLDERInterface
    {
        if (\$this->PROPERTYNAMEPLACEHOLDER !== null) {
            throw new \LogicException('DAONAMEPLACEHOLDER PROPERTYNAMEPLACEHOLDER is already set.');
        }
        \$this->PROPERTYNAMEPLACEHOLDER = \$PROPERTYNAMEPLACEHOLDER;
        return \$this;
    }
    
EOF;

    protected const HAS_METHOD_PATTERN = <<<EOF
    public function hasCAMELCASEPROPERTYNAMEPLACEHOLDER() : bool 
    {
        return \$this->PROPERTYNAMEPLACEHOLDER !== null;
    }
    
EOF;


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

        $this->generateService();

        return $this;
    }

    protected function replaceEntityPlaceholders(string $fileContent) : string
    {
        $fileContent = str_replace(self::DAO_NAME_PLACEHOLDER, $this->getMeta()->getDaoName(), $fileContent);
        $fileContent = str_replace(self::METHODS_PLACEHOLDER, $this->getClassMethodsString(), $fileContent);
        $fileContent = str_replace(self::CLASS_PROPERTIES_PLACEHOLDER, $this->getClassPropertiesString(), $fileContent);

        return $this->getStringReplacerFactory()
            ->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
            ->setFile($fileContent)
            ->replacePlaceholders();
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

            $methodString .=
                self::GET_METHOD_PATTERN . "\n" .
                self::SET_METHOD_PATTERN . "\n" .
                self::HAS_METHOD_PATTERN . "\n";

            $methodString = str_replace(
                [
                    self::DAO_NAME_PLACEHOLDER,
                    self::CAMEL_CASE_PROPERTYNAME_PLACEHOLDER,
                    self::PROPERTY_NAME_PLACEHOLDER,
                    self::PROPERTY_TYPE_PLACEHOLDER
                ],
                [
                    $this->getMeta()->getDaoName(),
                    $camelCaseProperty,
                    $property,
                    $values['php_type']
                ],
                $methodString
            );
        }

        return $methodString;
    }

    protected function getClassPropertiesString() : string
    {
       $classPropertiesString = '';

       foreach ($this->getMeta()->getDaoProperties() as $property => $values) {
           $classPropertiesString .= "\t" . 'protected $' . $property . ";\n";
       }

       return $classPropertiesString;
    }

    protected function generateService() : GeneratorInterface
    {
        $class = $this->getMeta()->getActorNamespace() . '\\' . $this->getActorName();
        $interface = $this->getMeta()->getActorNamespace() . '\\' . $this->getActorName() . 'Interface';

        $yaml = [
            'services' => [
                $interface => [
                    'class' => $class,
                    'public' => false,
                    'shared' => true,
                ]
            ]
        ];

        $preparedYaml = Yaml::dump($yaml, 4, 2);
        file_put_contents($this->getMeta()->getActorFilePath() . '/' . $this->getActorName() . '.yml', $preparedYaml);

        return $this;
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
        return $this->getMeta()->getDaoName();
    }
}
