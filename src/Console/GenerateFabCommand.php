<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\AwareTrait;
use Neighborhoods\Prefab\Builder;
use Neighborhoods\Prefab\Factory;
use Neighborhoods\Prefab\Map;
use Neighborhoods\Prefab\Repository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class GenerateFabCommand extends Command
{
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

        $this->srcLocation = '/var/www/html/prefab_fitness.neighborhoods.com/JakeService/src';
        $this->fabLocation = '/var/www/html/prefab_fitness.neighborhoods.com/JakeService/fab';
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

        foreach ($daos as $dao) {
            $this->generateDaoMeta($dao);
            $this->addDaoToList();
            $this->unsetDaoMeta();
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

    protected function generateDaoMeta(SplFileInfo $dao)
    {
        $this->setDaoName($dao->getBasename('.php'));
        $this->setDaoRelativePath($dao->getRelativePath());
        $this->setDaoNamespace($this->getDaoNamespaceFromFile($dao));

        return $this;
    }

    protected function unsetDaoMeta()
    {
        $this->unsetDaoName();
        $this->unsetDaoRelativePath();
        $this->unsetDaoNamespace();

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

    protected function addDaoToList(): self
    {
        $filePath = $this->fabLocation . self::FORWARD_SLASH . $this->getDaoRelativePath();

//        $daoMeta = new GeneratorMeta();
//        $daoMeta->setActorNamespace($this->getDaoNamespace());
//        $daoMeta->setActorFilepath($filePath);

        /** @todo DAO generator logic + Service.yml */

        $nextLevelNamespace = $this->getDaoNamespace() . self::BACKSLASH . $this->getDaoName();
        $nextLevelFilePath = $filePath . self::FORWARD_SLASH . $this->getDaoName();

        $nextLevelMeta = new GeneratorMeta();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);
        $nextLevelMeta->setDaoName($this->getDaoName());

        //$this->addServiceToList($daoMeta);
        $this->addAwareTraitToList($nextLevelMeta);
        $this->addFactoryToList($nextLevelMeta);
        $this->addMapToList($nextLevelMeta);
        $this->addRepositoryToList($nextLevelMeta);

        return $this;
    }

    protected function addServiceToList(GeneratorMetaInterface $serviceMeta): self
    {
        /** @todo Service generator logic */

        return $this;
    }

    protected function addAwareTraitToList(GeneratorMetaInterface $meta): self
    {
        $awareTraitGenerator = new AwareTrait\Generator();
        $awareTraitGenerator->setMeta($meta);
        $this->appendGeneratorToBuildPlan($awareTraitGenerator);

        return $this;
    }

    protected function addBuilderToList(GeneratorMetaInterface $builderMeta): self
    {
        $builderGenerator = new Builder\Generator();
        $builderGenerator->setMeta($builderMeta);
        $this->appendGeneratorToBuildPlan($builderGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($builderGenerator);

        $this->addAwareTraitToList($nextLevelMeta);
        $this->addFactoryToList($nextLevelMeta);

        return $this;
    }

    protected function addFactoryToList(GeneratorMetaInterface $factoryMeta): self
    {
        $factoryGenerator = new Factory\Generator();
        $factoryGenerator->setMeta($factoryMeta);
        $this->appendGeneratorToBuildPlan($factoryGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($factoryGenerator);

        $this->addAwareTraitToList($nextLevelMeta);

        return $this;
    }

    protected function addMapToList(GeneratorMetaInterface $mapMeta): self
    {
        $mapGenerator = new Map\Generator();
        $mapGenerator->setMeta($mapMeta);
        $this->appendGeneratorToBuildPlan($mapGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($mapGenerator);

        $this->addAwareTraitToList($nextLevelMeta);
        $this->addBuilderToList($nextLevelMeta);
        $this->addFactoryToList($nextLevelMeta);

        return $this;
    }

    protected function addRepositoryToList(GeneratorMetaInterface $repositoryMeta): self
    {
        $repositoryGenerator = new Repository\Generator();
        $repositoryGenerator->setMeta($repositoryMeta);
        $this->appendGeneratorToBuildPlan($repositoryGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($repositoryGenerator);

        $this->addAwareTraitToList($nextLevelMeta);

        return $this;
    }

    protected function getNextLevelMeta(GeneratorInterface $parentGenerator): GeneratorMetaInterface
    {
        $parentMeta = $parentGenerator->getMeta();
        $actorName = $parentGenerator->getActorName();
        $nextLevelNamespace = $parentMeta->getActorNamespace() . self::BACKSLASH . $actorName;
        $nextLevelFilePath = $parentMeta->getActorFilePath() . self::FORWARD_SLASH . $actorName;

        $nextLevelMeta = new GeneratorMeta();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);
        $nextLevelMeta->setDaoName($this->getDaoName());

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

    protected function getDaoName(): string
    {
        if ($this->daoName === null) {
            throw new \LogicException('GenerateFabCommand daoName has not been set.');
        }
        return $this->daoName;
    }

    protected function setDaoName(string $daoName)
    {
        if ($this->daoName !== null) {
            throw new \LogicException('GenerateFabCommand daoName is already set.');
        }
        $this->daoName = $daoName;
        return $this;
    }

    protected function unsetDaoName()
    {
        if ($this->daoName === null) {
            throw new \LogicException('GenerateFabCommand daoName has not been set.');
        }
        $this->daoName = null;
        return $this;
    }

    protected function getDaoNamespace(): string
    {
        if ($this->daoNamespace === null) {
            throw new \LogicException('GenerateFabCommand daoNamespace has not been set.');
        }
        return $this->daoNamespace;
    }

    protected function setDaoNamespace(string $daoNamespace)
    {
        if ($this->daoNamespace !== null) {
            throw new \LogicException('GenerateFabCommand daoNamespace is already set.');
        }
        $this->daoNamespace = $daoNamespace;
        return $this;
    }

    protected function unsetDaoNamespace()
    {
        if ($this->daoNamespace === null) {
            throw new \LogicException('GenerateFabCommand daoNamespace has not been set.');
        }
        $this->daoNamespace = null;
        return $this;
    }

    protected function getDaoRelativePath(): string
    {
        if ($this->daoRelativePath === null) {
            throw new \LogicException('GenerateFabCommand daoRelativePath has not been set.');
        }
        return $this->daoRelativePath;
    }

    protected function setDaoRelativePath(string $daoRelativePath)
    {
        if ($this->daoRelativePath !== null) {
            throw new \LogicException('GenerateFabCommand daoRelativePath is already set.');
        }
        $this->daoRelativePath = $daoRelativePath;
        return $this;
    }

    protected function unsetDaoRelativePath()
    {
        if ($this->daoRelativePath === null) {
            throw new \LogicException('GenerateFabCommand daoRelativePath has not been set.');
        }
        $this->daoRelativePath = null;
        return $this;
    }
}
