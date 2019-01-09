<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\HTTP;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Protean\Container\Builder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Symfony\Component\DependencyInjection\ErrorHandler;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Symfony\Component\DependencyInjection\ExceptionHandler;

set_exception_handler(new ExceptionHandler());
set_error_handler(new ErrorHandler());
$proteanContainerBuilder = new Builder();
$proteanContainerBuilder->getFilesystemProperties()->setRootDirectoryPath(realpath(__DIR__ . '/../'));
$HTTP = (new HTTP())->setProteanContainerBuilder($proteanContainerBuilder);
$HTTP->respond();

return;
