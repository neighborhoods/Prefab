<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\HTTP;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Protean\Container\Builder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Symfony\Component\DependencyInjection\ErrorHandler;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Symfony\Component\DependencyInjection\ExceptionHandler;

set_exception_handler(new ExceptionHandler());
set_error_handler(new ErrorHandler());
$proteanContainerBuilder = new Builder();
$proteanContainerBuilder->getFilesystemProperties()->setRootDirectoryPath(realpath(__DIR__ . '/../'));
$HTTP = (new HTTP())->setProteanContainerBuilder($proteanContainerBuilder);
$HTTP->respond();

return;
