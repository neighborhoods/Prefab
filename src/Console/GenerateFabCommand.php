<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Map\Generator;
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

    protected function assembleBuildPlan()
    {
        $daoAnnotationPattern = '#@neighborhoods\\\prefab:DAO\n#s';

        $finder = new Finder();
        $daos = $finder->files()->contains($daoAnnotationPattern)->in($this->srcLocation);

        foreach ($daos as $dao) {
            $this->generateDaoMeta($dao);
            $this->addDaoToList();
        }
    }

    protected function generateDaoMeta(SplFileInfo $dao)
    {
        $this->setDaoName($dao->getBasename('.php'));
        $this->setDaoRelativePath($dao->getRelativePath());
        $this->setDaoNamespace($this->getDaoNamespaceFromFile($dao));
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

        $daoMeta = new GeneratorMeta();
        $daoMeta->setActorNamespace($this->getDaoNamespace());
        $daoMeta->setActorFilepath($filePath);

        /** @todo DAO generator logic + Service.yml */

        $nextLevelNamespace = $this->getDaoNamespace() . self::BACKSLASH . $this->getDaoName();
        $nextLevelFilePath = $filePath . self::FORWARD_SLASH . $this->getDaoName();

        $nextLevelMeta = new GeneratorMeta();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);

        $this->addServiceToList($daoMeta);
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
        /** @todo AwareTrait generator logic */

        return $this;
    }

    protected function addBuilderToList(GeneratorMetaInterface $builderMeta): self
    {
        $actorName = 'Builder';

        /** @todo Builder generator logic */

        $nextLevelNamespace = $builderMeta->getActorNamespace() . self::BACKSLASH . $actorName;
        $nextLevelFilePath = $builderMeta->getActorFilePath() . self::FORWARD_SLASH . $actorName;

        $nextLevelMeta = new GeneratorMeta();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);

        $this->addAwareTraitToList($nextLevelMeta);
        $this->addFactoryToList($nextLevelMeta);

    }

    protected function addFactoryToList(GeneratorMetaInterface $factoryMeta): self
    {
        $actorName = 'Factory';

        /** @todo Factory generator logic */

        $nextLevelNamespace = $factoryMeta->getActorNamespace() . self::BACKSLASH . $actorName;
        $nextLevelFilePath = $factoryMeta->getActorFilePath() . self::FORWARD_SLASH . $actorName;

        $nextLevelMeta = new GeneratorMeta();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);

        $this->addAwareTraitToList($nextLevelMeta);

        return $this;
    }

    protected function addMapToList(GeneratorMetaInterface $mapMeta): self
    {
        $actorName = 'Map';

        $mapGenerator = new Generator();
        $mapGenerator->setMeta($mapMeta);
        $this->appendGeneratorToBuildPlan($mapGenerator);

        $nextLevelNamespace = $mapMeta->getActorNamespace() . self::BACKSLASH . $actorName;
        $nextLevelFilePath = $mapMeta->getActorFilePath() . self::FORWARD_SLASH . $actorName;

        $nextLevelMeta = new GeneratorMeta();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);

        $this->addAwareTraitToList($nextLevelMeta);
        $this->addBuilderToList($nextLevelMeta);
        $this->addFactoryToList($nextLevelMeta);

        return $this;
    }

    protected function addRepositoryToList(GeneratorMetaInterface $repositoryMeta): self
    {
        $actorName = 'Repository';

        /** @todo Repository generator logic */

        $nextLevelNamespace = $repositoryMeta->getActorNamespace() . self::BACKSLASH . $actorName;
        $nextLevelFilePath = $repositoryMeta->getActorFilePath() . self::FORWARD_SLASH . $actorName;

        $nextLevelMeta = new GeneratorMeta();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);

        $this->addAwareTraitToList($nextLevelMeta);

        return $this;
    }

    public function appendGeneratorToBuildPlan(GeneratorInterface $generator)
    {
        $this->buildPlan[] = $generator;
        return $this;
    }

    public function getBuildPlan(): array
    {
        if ($this->buildPlan === null) {
            throw new \LogicException('GenerateFabCommand buildPlan has not been set.');
        }
        return $this->buildPlan;
    }

    public function getDaoName(): string
    {
        if ($this->daoName === null) {
            throw new \LogicException('GenerateFabCommand daoName has not been set.');
        }
        return $this->daoName;
    }

    public function setDaoName(string $daoName)
    {
        if ($this->daoName !== null) {
            throw new \LogicException('GenerateFabCommand daoName is already set.');
        }
        $this->daoName = $daoName;
        return $this;
    }

    public function getDaoNamespace(): string
    {
        if ($this->daoNamespace === null) {
            throw new \LogicException('GenerateFabCommand daoNamespace has not been set.');
        }
        return $this->daoNamespace;
    }

    public function setDaoNamespace(string $daoNamespace)
    {
        if ($this->daoNamespace !== null) {
            throw new \LogicException('GenerateFabCommand daoNamespace is already set.');
        }
        $this->daoNamespace = $daoNamespace;
        return $this;
    }

    public function getDaoRelativePath(): string
    {
        if ($this->daoRelativePath === null) {
            throw new \LogicException('GenerateFabCommand daoRelativePath has not been set.');
        }
        return $this->daoRelativePath;
    }

    public function setDaoRelativePath(string $daoRelativePath)
    {
        if ($this->daoRelativePath !== null) {
            throw new \LogicException('GenerateFabCommand daoRelativePath is already set.');
        }
        $this->daoRelativePath = $daoRelativePath;
        return $this;
    }
}
