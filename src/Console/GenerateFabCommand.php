<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\AwareTrait;
use Neighborhoods\Prefab\Builder;
use Neighborhoods\Prefab\BuilderInterface;
use Neighborhoods\Prefab\Factory;
use Neighborhoods\Prefab\FactoryInterface;
use Neighborhoods\Prefab\Handler;
use Neighborhoods\Prefab\HandlerInterface;
use Neighborhoods\Prefab\Repository;
use Neighborhoods\Prefab\RepositoryInterface;
use Neighborhoods\Prefab\ClassSaver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class GenerateFabCommand extends Command
{
    protected function configure()
    {
        $this->setName('gen:fab')
            ->setDescription('Generate Protean Machinery');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = new AwareTrait\Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake');
        $generator->setClassSaver(new ClassSaver());
        $generator->generate();

        $generator = new Builder\Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake');
        $generator->setClassSaver(new ClassSaver());
        $generator->generate();

        $generator = new BuilderInterface\Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake');
        $generator->setClassSaver(new ClassSaver());
        $generator->generate();

        $generator = new Factory\Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake');
        $generator->setClassSaver(new ClassSaver());
        $generator->generate();

        $generator = new FactoryInterface\Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake');
        $generator->setClassSaver(new ClassSaver());
        $generator->generate();

        $generator = new Handler\Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake\Repository');
        $generator->setClassSaver(new ClassSaver());
        $generator->generate();

        $generator = new HandlerInterface\Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake\Repository');
        $generator->setClassSaver(new ClassSaver());
        $generator->generate();

        $generator = new Repository\Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake');
        $generator->setClassSaver(new ClassSaver());
        $generator->generate();

        $generator = new RepositoryInterface\Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake');
        $generator->setClassSaver(new ClassSaver());
        $generator->generate();

        $output->writeln('Done.');
    }
}
