<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTP;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\ErrorHandler;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\ExceptionHandler;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;

$logger = (new Logger())
    ->setLogFilePath(__DIR__ . '/../Logs/HTTP.log');

$exceptionHandler = (new ExceptionHandler())->setPrefab5Logger($logger);

set_exception_handler($exceptionHandler);
set_error_handler(new ErrorHandler());
$proteanContainerBuilder = new Builder();
$proteanContainerBuilder->getFilesystemProperties()->setRootDirectoryPath(realpath(__DIR__ . '/../'));
$HTTP = (new HTTP())->setProteanContainerBuilder($proteanContainerBuilder);
$HTTP->respond();

return;
