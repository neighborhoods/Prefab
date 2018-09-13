<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\AwareTrait\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Zend\Code\Reflection\FileReflection;

class GenerateFabCommand extends Command
{
    protected function configure()
    {
        $this->setName('gen:fab')
            ->setDescription('Generate Protean Machinery');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = new Generator();
        $generator->setNamespace('Neighborhoods\PrefabFitnessJakeService\Jake');
        $daoLocation = '/var/www/html/prefab_fitness.neighborhoods.com/JakeService/src';
        $generator->setVersion('MV1');
        $generator->setProjectName('PrefabFitnessJakeService');
        $finder = new Finder();
        $daos = $finder->files()->in($daoLocation);

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $template = new FileReflection($dao->getPath() . DIRECTORY_SEPARATOR . $dao->getFilename(), true);
            $class = $template->getClass();
            $generator->generate($dao);
            break;
        }

        $output->writeln('Done.');
    }
}
