<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class GenerateFabCommand extends Command implements GenerateFabCommandInterface
{

    use Generator\AwareTrait;

    protected function configure() : GenerateFabCommandInterface
    {
        $this->setName('gen:fab')
            ->setDescription('Generate Protean Machinery');

        return $this;
    }

    protected function execute(InputInterface $input, OutputInterface $output) : GenerateFabCommandInterface
    {
        return $this;
    }
}
