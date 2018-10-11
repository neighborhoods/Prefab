<?php
declare(strict_types=1);
error_reporting(E_ALL);

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\HTTP;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Protean\Container\Builder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Symfony\Component\DependencyInjection\ErrorHandler;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Symfony\Component\DependencyInjection\ExceptionHandler;

require_once __DIR__ . '/../vendor/autoload.php';

set_error_handler(new ErrorHandler());
set_exception_handler(new ExceptionHandler());
$proteanContainerBuilder = (new Builder())->setApplicationRootDirectoryPath(realpath(__DIR__ . '/../'));
$HTTP = (new HTTP())->setProteanContainerBuilder($proteanContainerBuilder);
$HTTP->respond();

return;
