<?php
declare(strict_types=1);
ini_set('assert.exception', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Neighborhoods\AreaService\ZFC\GenerateFabCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GenerateFabCommand());
$application->run();
