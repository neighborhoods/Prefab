<?php
declare(strict_types=1);

namespace Neighborhoods\AreaService\ZFC;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateFabCommand extends Command
{
    protected function configure()
    {
        $this->setName('gen:fab')
            ->setDescription('Generate Protean Machinery');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        new Map();
        $output->writeln('Done.');
    }
}
