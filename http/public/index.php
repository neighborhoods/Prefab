<?php
declare(strict_types=1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Fig\Http\Message\StatusCodeInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\ErrorHandler;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\ExceptionHandler;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTP;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;

try {
    $logger = (new Logger())->setLogFilePath(__DIR__ . '/../Logs/HTTP.log');
    $exceptionHandler = (new ExceptionHandler())->setPrefab5Logger($logger);
    set_exception_handler($exceptionHandler);
    set_error_handler(new ErrorHandler());

    $httpBuildableDirectoryContainerBuilder = new HTTPBuildableDirectoryMap\ContainerBuilder();

    $HTTP = (new HTTP())
        ->setPrefab5HTTPBuildableDirectoryMapContainerBuilder($httpBuildableDirectoryContainerBuilder)
        ->setRootDirectoryPath(realpath(__DIR__ . '/../'))
        ->respond();
} catch (\Throwable $throwable) {
    http_response_code(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);

    if (getenv('DEBUG_MODE') === 'true') {
        if (defined('STDERR')) {
            // Should exist from a CLI context
            fwrite(STDERR, $throwable->__toString() . PHP_EOL);
        }
        (new Logger())
            ->setLogFilePath(__DIR__ . '/../Logs/HTTP.log')
            ->critical($throwable->__toString() . PHP_EOL);
    }

    // Try to send the error to DataDog
    $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
    $tracer = $repository->get();
    $span = $tracer->getActiveSpan();
    if ($span !== null) {
        $span->setError($throwable);
    }
}

return;
