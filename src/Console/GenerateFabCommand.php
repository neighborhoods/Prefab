<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\Actor\AwareTrait;
use Neighborhoods\Prefab\Actor\Builder;
use Neighborhoods\Prefab\Actor\BuilderInterface;
use Neighborhoods\Prefab\Actor\Factory;
use Neighborhoods\Prefab\Actor\FactoryInterface;
use Neighborhoods\Prefab\Actor\Handler;
use Neighborhoods\Prefab\Actor\HandlerInterface;
use Neighborhoods\Prefab\Actor\Map;
use Neighborhoods\Prefab\Actor\MapInterface;
use Neighborhoods\Prefab\Actor\Repository;
use Neighborhoods\Prefab\Actor\RepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class GenerateFabCommand extends Command
{
    use AwareTrait\Generator\Factory\AwareTrait;
    use Builder\Generator\Factory\AwareTrait;
    use BuilderInterface\Generator\Factory\AwareTrait;
    use Factory\Generator\Factory\AwareTrait;
    use FactoryInterface\Generator\Factory\AwareTrait;
    use Handler\Generator\Factory\AwareTrait;
    use HandlerInterface\Generator\Factory\AwareTrait;
    use Map\Generator\Factory\AwareTrait;
    use MapInterface\Generator\Factory\AwareTrait;
    use Repository\Generator\Factory\AwareTrait;
    use RepositoryInterface\Generator\Factory\AwareTrait;
    use GeneratorMeta\Factory\AwareTrait;

    const FORWARD_SLASH = '/';
    const BACKSLASH = '\\';

    /** @var array */
    protected $buildPlan = [];
    /** @var string */
    protected $daoName;
    /** @var string */
    protected $daoNamespace;
    /** @var string */
    protected $daoRelativePath;
    /** @var string */
    protected $fabLocation;
    /** @var string */
    protected $srcLocation;

    protected function configure()
    {
        $this->setName('gen:fab')
            ->setDescription('Generate Protean Machinery');

        // We should probably do something better than this
        $this->srcLocation = __DIR__ . '/../../../../../src';
        $this->fabLocation = __DIR__ . '/../../../../../fab';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Assembling Prefab build plan.');
        $this->assembleBuildPlan();
        $output->writeln('Build plan complete.');

        $output->writeln('Generating prefab machinery.');
        $this->generatePrefab();
        $output->writeln('Prefab generation complete.');

        return $this;
    }

    protected function assembleBuildPlan()
    {
        $daoAnnotationPattern = '#@neighborhoods\\\prefab:DAO\n#s';

        $finder = new Finder();
        $daos = $finder->files()->contains($daoAnnotationPattern)->in($this->srcLocation);

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $daoName = $dao->getBasename('.php');
            $daoFilePath = $this->fabLocation . self::FORWARD_SLASH . $dao->getRelativePath();
            $daoNamespace = $this->getDaoNamespaceFromFile($dao);

            $daoMeta = $this->getConsoleGeneratorMetaFactory()->create();
            $daoMeta->setDaoName($daoName);
            $daoMeta->setActorNamespace($daoNamespace);
            $daoMeta->setActorFilePath($daoFilePath);

            $this->addDaoToPlan($daoMeta);
        }

        return $this;
    }

    protected function generatePrefab()
    {
        $generatorList = $this->getBuildPlan();
        /** @var GeneratorInterface $generator */
        foreach ($generatorList as $generator) {
            $generator->generate();
        }

        return $this;
    }

    protected function getDaoNamespaceFromFile(SplFileInfo $dao)
    {
        preg_match('#namespace (.*?);#s', $dao->getContents(), $namespace);

        return $namespace[1];
    }

    protected function getPrefabAnnotations(SplFileInfo $file): array
    {
        preg_match_all('#@neighborhoods\\\prefab:(.*?)\n#s', $file->getContents(), $annotations);
        return $annotations[1];
    }

    protected function addDaoToPlan(GeneratorMetaInterface $daoMeta): self
    {
        /** @todo DAO generator logic + Service.yml */

        $nextLevelNamespace = $daoMeta->getActorNamespace() . self::BACKSLASH . $daoMeta->getDaoName();
        $nextLevelFilePath = $daoMeta->getActorFilePath() . self::FORWARD_SLASH . $daoMeta->getDaoName();

        // Once we have a DAO generator, we can pass it to getNextLevelMeta() instead of setting it all here.
        $nextLevelMeta = $this->getConsoleGeneratorMetaFactory()->create();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);
        $nextLevelMeta->setDaoName($daoMeta->getDaoName());

        //$this->addServiceToPlan($daoMeta);
        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);
        $this->addMapToPlan($nextLevelMeta);
        $this->addRepositoryToPlan($nextLevelMeta);
        $this->addRepositoryInterfaceToPlan($nextLevelMeta);
        $this->addBuilderToPlan($nextLevelMeta);
        $this->addBuilderInterfaceToPlan($nextLevelMeta);

        return $this;
    }

    protected function addAwareTraitToPlan(GeneratorMetaInterface $meta): self
    {
        $awareTraitGenerator = $this->getActorAwareTraitGeneratorFactory()->create();
        $awareTraitGenerator->setMeta($meta);
        $this->appendGeneratorToBuildPlan($awareTraitGenerator);

        return $this;
    }

    protected function addBuilderToPlan(GeneratorMetaInterface $builderMeta): self
    {
        $builderGenerator = $this->getActorBuilderGeneratorFactory()->create();
        $builderGenerator->setMeta($builderMeta);
        $this->appendGeneratorToBuildPlan($builderGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($builderGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);

        return $this;
    }

    protected function addBuilderInterfaceToPlan(GeneratorMetaInterface $builderInterfaceMeta): self
    {
        $builderInterfaceGenerator = $this->getActorBuilderInterfaceGeneratorFactory()->create();
        $builderInterfaceGenerator->setMeta($builderInterfaceMeta);
        $this->appendGeneratorToBuildPlan($builderInterfaceGenerator);

        return $this;
    }

    protected function addFactoryToPlan(GeneratorMetaInterface $factoryMeta): self
    {
        $factoryGenerator = $this->getActorFactoryGeneratorFactory()->create();
        $factoryGenerator->setMeta($factoryMeta);
        $this->appendGeneratorToBuildPlan($factoryGenerator);
        $this->addFactoryInterfaceToPlan($factoryMeta);

        $nextLevelMeta = $this->getNextLevelMeta($factoryGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);

        return $this;
    }

    protected function addFactoryInterfaceToPlan(GeneratorMetaInterface $factoryInterfaceMeta): self
    {
        $factoryInterfaceGenerator = $this->getActorFactoryInterfaceGeneratorFactory()->create();
        $factoryInterfaceGenerator->setMeta($factoryInterfaceMeta);
        $this->appendGeneratorToBuildPlan($factoryInterfaceGenerator);
        return $this;
    }

    protected function addHandlerToPlan(GeneratorMetaInterface $handlerMeta): self
    {
        $handlerGenerator = $this->getActorHandlerGeneratorFactory()->create();
        $handlerGenerator->setMeta($handlerMeta);
        $this->appendGeneratorToBuildPlan($handlerGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($handlerGenerator);
        $this->addAwareTraitToPlan($nextLevelMeta);
        return $this;
    }

    protected function addHandlerInterfaceToPlan(GeneratorMetaInterface $handlerInterfaceMeta): self
    {
        $handlerInterfaceGenerator = $this->getActorHandlerInterfaceGeneratorFactory()->create();
        $handlerInterfaceGenerator->setMeta($handlerInterfaceMeta);
        $this->appendGeneratorToBuildPlan($handlerInterfaceGenerator);
        return $this;
    }

    protected function addMapToPlan(GeneratorMetaInterface $mapMeta): self
    {
        $mapGenerator = $this->getMapGeneratorFactory()->create();
        $mapGenerator->setMeta($mapMeta);
        $this->appendGeneratorToBuildPlan($mapGenerator);
        $this->addMapInterfaceToPlan($mapMeta);

        $nextLevelMeta = $this->getNextLevelMeta($mapGenerator);
        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addBuilderToPlan($nextLevelMeta);
        $this->addBuilderInterfaceToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);

        return $this;
    }

    protected function addMapInterfaceToPlan(GeneratorMetaInterface $mapInterfaceMeta): self
    {
        $mapInterfaceGenerator = $this->getMapInterfaceGeneratorFactory()->create();
        $mapInterfaceGenerator->setMeta($mapInterfaceMeta);
        $this->appendGeneratorToBuildPlan($mapInterfaceGenerator);

        return $this;
    }


    protected function addRepositoryToPlan(GeneratorMetaInterface $repositoryMeta): self
    {
        $repositoryGenerator = $this->getActorRepositoryGeneratorFactory()->create();
        $repositoryGenerator->setMeta($repositoryMeta);
        $this->appendGeneratorToBuildPlan($repositoryGenerator);
        $this->addRepositoryInterfaceToPlan($repositoryMeta);

        $nextLevelMeta = $this->getNextLevelMeta($repositoryGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addHandlerToPlan($nextLevelMeta);
        $this->addHandlerInterfaceToPlan($nextLevelMeta);

        return $this;
    }

    protected function addRepositoryInterfaceToPlan(GeneratorMetaInterface $repositoryInterfaceMeta): self
    {
        $repositoryInterfaceGenerator = $this->getActorRepositoryInterfaceGeneratorFactory()->create();
        $repositoryInterfaceGenerator->setMeta($repositoryInterfaceMeta);
        $this->appendGeneratorToBuildPlan($repositoryInterfaceGenerator);

        return $this;
    }

    protected function addServiceToPlan(GeneratorMetaInterface $serviceMeta): self
    {
        /** @todo Service generator logic */

        return $this;
    }

    protected function getNextLevelMeta(GeneratorInterface $parentGenerator): GeneratorMetaInterface
    {
        $parentMeta = $parentGenerator->getMeta();
        $actorName = $parentGenerator->getActorName();
        $nextLevelNamespace = $parentMeta->getActorNamespace() . self::BACKSLASH . $actorName;
        $nextLevelFilePath = $parentMeta->getActorFilePath() . self::FORWARD_SLASH . $actorName;

        $nextLevelMeta = $this->getConsoleGeneratorMetaFactory()->create();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);
        $nextLevelMeta->setDaoName($parentMeta->getDaoName());

        return $nextLevelMeta;
    }

    protected function appendGeneratorToBuildPlan(GeneratorInterface $generator)
    {
        $this->buildPlan[] = $generator;
        return $this;
    }

    protected function getBuildPlan(): array
    {
        if ($this->buildPlan === null) {
            throw new \LogicException('GenerateFabCommand buildPlan has not been set.');
        }
        return $this->buildPlan;
    }
}
