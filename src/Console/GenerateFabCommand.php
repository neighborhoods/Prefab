<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\FactoryInterface\Generator;
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
        $daoLocation = '/var/www/html/prefab_fitness.neighborhoods.com/JakeService/src';

        $generator = new Generator();
        $finder = new Finder();

        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake');
        $generator->setVersion('MV1');

        $daos = $finder->files()->depth(0)->in($daoLocation);

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $generator->generate($dao);
            break;
        }

        $output->writeln('Done.');
    }
}
