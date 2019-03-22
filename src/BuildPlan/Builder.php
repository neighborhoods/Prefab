<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan;


use Neighborhoods\Prefab\BuildPlan;
use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\BuildPlanInterface;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Neighborhoods\Prefab\Actor;
use Neighborhoods\Prefab\Actor\DAOInterface;
use Neighborhoods\Prefab\Actor\DAO;
use Neighborhoods\Prefab\Console\GeneratorMeta;
use Neighborhoods\Prefab\Zend;

class Builder implements BuilderInterface
{
    use BuildPlan\Factory\AwareTrait;
    use GeneratorMeta\Factory\AwareTrait;
    use DAOInterface\Generator\Factory\AwareTrait;
    use DAO\Generator\Factory\AwareTrait;

    const FORWARD_SLASH = '/';
    const BACKSLASH = '\\';
    const DAO_YML_SUFFIX = '.prefab.definition.yml';

    protected $buildConfiguration;
    protected $buildPlan;

    public function build() : BuildPlanInterface
    {
        $this->setBuildPlan($this->getBuildPlanFactory()->create());
        $daoMeta = $this->getConsoleGeneratorMetaFactory()->create();

        $actorFilePath = str_replace(
            '/' . $this->getDaoName() . self::DAO_YML_SUFFIX,
            '',
            $this->getBuildConfiguration()->getRootSaveLocation()
        );

        // Get the namespace based on the filepath
        $namespacePrefix = 'Neighborhoods\\' . $this->getBuildConfiguration()->getProjectName();

        $filepathArray = explode('fab', $actorFilePath);
        $namespaceSuffix = $filepathArray[count($filepathArray) - 1];
        $namespaceSuffix = str_replace('/', '\\', $namespaceSuffix);
        $namespace = $namespacePrefix . $namespaceSuffix;

        $daoMeta->setDaoName($this->getDaoName());
        $daoMeta->setActorNamespace($namespace);
        $daoMeta->setActorFilePath($actorFilePath);
        $daoMeta->setDaoProperties($this->getBuildConfiguration()->getDaoProperties());

        if ($this->getBuildConfiguration()->hasHttpRoute()) {
            $daoMeta->setHttpRoute($this->getBuildConfiguration()->getHttpRoute());
        }

        $this->addDaoInterfaceToPlan($daoMeta);
        $this->addDaoToPlan($daoMeta);

        return $this->getBuildPlan();
    }

    protected function getDaoName() : string
    {
        $rootSaveLocationParts = explode('/', $this->getBuildConfiguration()->getRootSaveLocation());

        return str_replace(
            self::DAO_YML_SUFFIX,
            '',
            end($rootSaveLocationParts)
        );
    }

    protected function addDaoToPlan(GeneratorMetaInterface $meta) : BuilderInterface
    {
        $daoGenerator = $this->getActorDAOGeneratorFactory()->create();
        $daoGenerator->setMeta($meta);
        $this->appendGeneratorToBuildPlan($daoGenerator);

        return $this;
    }

    protected function addDaoInterfaceToPlan(GeneratorMetaInterface $meta) : BuilderInterface
    {
        $daoInterfaceGenerator = $this->getActorDAOInterfaceGeneratorFactory()->create();
        $meta->setDaoIdentityField($this->getBuildConfiguration()->getDaoIdentityField());
        $meta->setTableName($this->getBuildConfiguration()->getTableName());
        $daoInterfaceGenerator->setMeta($meta);
        $this->appendGeneratorToBuildPlan($daoInterfaceGenerator);

        return $this;
    }

    protected function addHandlerToRouteFile(GeneratorMetaInterface $meta) : BuilderInterface
    {
        // Symfony Yaml doesn't support adding !php/const, so we have to create the string and append it to the end of the file

        $routePath = $this->getBuildConfiguration()->getProjectDir() . 'fab/Prefab5/Zend/Expressive/Application/Decorator.service.yml';
        $file = file_get_contents($routePath);

        $line =
            "    - [get, [!php/const \\" . $meta->getActorNamespace() . "\HandlerInterface::ROUTE_PATH_" . strtoupper($this->getDaoName()) . "S," .
            "'@" . $meta->getActorNamespace() ."\HandlerInterface'," .
            "!php/const \\" . $meta->getActorNamespace() . "\HandlerInterface::ROUTE_NAME_" . strtoupper($this->getDaoName()) . "S]]\n";

        $file .= $line;

        file_put_contents($routePath, $file);

        return $this;
    }

    protected function appendGeneratorToBuildPlan(GeneratorInterface $generator) : BuilderInterface
    {
        $this->getBuildPlan()->appendGenerator($generator);
        return $this;
    }


    protected function getBuildConfiguration() : BuildConfigurationInterface
    {
        if ($this->buildConfiguration === null) {
            throw new \LogicException('Builder buildConfiguration has not been set.');
        }
        return $this->buildConfiguration;
    }

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface
    {
        if ($this->buildConfiguration !== null) {
            throw new \LogicException('Builder buildConfiguration is already set.');
        }
        $this->buildConfiguration = $buildConfiguration;
        return $this;
    }

    protected function getBuildPlan() : BuildPlanInterface
    {
        if ($this->buildPlan === null) {
            throw new \LogicException('Builder buildPlan has not been set.');
        }
        return $this->buildPlan;
    }

    protected function setBuildPlan(BuildPlanInterface $buildPlan) : BuilderInterface
    {
        if ($this->buildPlan !== null) {
            throw new \LogicException('Builder buildPlan is already set.');
        }
        $this->buildPlan = $buildPlan;
        return $this;
    }
}
