<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Map;

use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Symfony\Component\Yaml\Yaml;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Reflection\ClassReflection;

class Generator implements GeneratorInterface
{
    use ClassSaver\Factory\AwareTrait;

    public const CLASS_NAME = 'Map';

    /** @var ClassGenerator */
    protected $generator;
    /** @var GeneratorMetaInterface */
    protected $meta;

    public function generate(): GeneratorInterface
    {
        $this->setGenerator();

        $meta = $this->getMeta();

        $this->getGenerator()->setName(self::CLASS_NAME);
        $this->getGenerator()->setNamespaceName($meta->getActorNamespace());
        $this->getGenerator()->setExtendedClass('\ArrayIterator');
        $this->getGenerator()->setImplementedInterfaces([$meta->getActorNamespace() . '\MapInterface']);
        $this->getGenerator()->addUse($meta->getActorNamespace() . '\MapInterface');

        $this->replaceReturnTypePlaceHolders();

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $this->getClassSaverFactory()->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
            ->setClassName(self::CLASS_NAME)
            ->setGeneratedClass($builtFile)
            ->saveClass();

        return $this;
    }

//
//    protected function generateMapService()
//    {
//        $yaml = Yaml::parseFile('/var/www/html/area_service.neighborhoods.com/VendorPrefab/src/Map/Service.yml');
//
//        $mapClass = $this->mapNamespace . '\\Map';
//        $mapInterface = $this->mapNamespace . '\\MapInterface';
//
//        $yaml['services'][$mapInterface] = $yaml['services']['REPLACE_DAO_MAP_INTERFACE'];
//        unset($yaml['services']['REPLACE_DAO_MAP_INTERFACE']);
//
//        $yaml['services'][$mapInterface]['class'] = $mapClass;
//
//        $preparedYaml = Yaml::dump($yaml,3,2);
//
//        file_put_contents($this->mapDirectory.'/Map.yml', $preparedYaml);
//
//        return $this;
//    }
//
//    protected function generateRepositoryService(SplFileInfo $dao)
//    {
//        $parent = $dao->getRelativePath();
//        $daoName = basename($dao->getFilename(),'.php');
//
//        $yaml = Yaml::parseFile('/var/www/html/area_service.neighborhoods.com/VendorPrefab/src/Repository/Service.yml');
//
//        $repositoryClass = $this->mapNamespace . '\\Repository';
//        $repositoryInterface = $this->mapNamespace . '\\RepositoryInterface';
//
//        $yaml['services'][$repositoryInterface] = $yaml['services']['REPLACE_DAO_REPOSITORY_INTERFACE'];
//        unset($yaml['services']['REPLACE_DAO_REPOSITORY_INTERFACE']);
//
//        $yaml['services'][$repositoryInterface]['class'] = $repositoryClass;
//
//        $calls = $yaml['services'][$repositoryInterface]['calls'];
//        $replacedCalls = [];
//
//        $versionedDaoName = $this->version.$parent.$daoName;
//        $fullDaoName = ($parent) ? $parent."\\\\".$daoName : $daoName;
//        foreach ($calls as $call) {
//            $json = json_encode($call);
//            $json = str_replace('REPLACE_VERSIONED_DAO_NAME', $versionedDaoName,$json);
//            $json = str_replace('REPLACE_DAO_VERSION', $this->version,$json);
//            $json = str_replace('REPLACE_DAO_NAME', $fullDaoName,$json);
//            $call = json_decode($json,true);
//            $replacedCalls[] = $call;
//        }
//        $yaml['services'][$repositoryInterface]['calls'] = $replacedCalls;
//
//        $preparedYaml = Yaml::dump($yaml,4,2);
//
//        file_put_contents($this->mapDirectory.'/Repository.yml', $preparedYaml);
//
//        return $this;
//    }

    protected function replaceReturnTypePlaceHolders()
    {
        $meta = $this->getMeta();
        $methods = $this->getGenerator()->getMethods();

        foreach ($methods as $method) {
            $returnType = $method->getReturnType();
            if ($returnType && strpos($returnType->generate(), 'REPLACE_DAO_NAMEInterface')) {
                $method->setReturnType($meta->getActorNamespace() . '\\' . $meta->getDaoName() . 'Interface');
            }
        }

        return $this;
    }

    protected function replaceEntityPlaceholders($fileContent)
    {
        $entityName = $this->getMeta()->getDaoName();
        $entityItemName = strtolower($entityName);
        $fileContent = str_replace('REPLACE_DAO_NAME', $entityName, $fileContent);
        $fileContent = str_replace('REPLACE_DAO_VAR', $entityItemName, $fileContent);
        return $fileContent;
    }

    protected function setGenerator() : GeneratorInterface
    {
        $template = new ClassReflection(Template::class);
        $this->generator = ClassGenerator::fromReflection($template);
        return $this;
    }

    protected function getGenerator() : ClassGenerator
    {
        if ($this->generator === null) {
            throw new \LogicException('Generator generator has not been set');
        }

        return $this->generator;
    }

    public function getMeta(): GeneratorMetaInterface
    {
        if ($this->meta === null) {
            throw new \LogicException('Generator meta has not been set.');
        }
        return $this->meta;
    }

    public function setMeta(GeneratorMetaInterface $meta): GeneratorInterface
    {
        if ($this->meta !== null) {
            throw new \LogicException('Generator meta is already set.');
        }
        $this->meta = $meta;
        return $this;
    }

    public function getActorName(): string
    {
        return self::CLASS_NAME;
    }
}
