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
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder;

try {
    $logger = (new Logger())->setLogFilePath(__DIR__ . '/../Logs/HTTP.log');
    $exceptionHandler = (new ExceptionHandler())->setPrefab5Logger($logger);
    set_exception_handler($exceptionHandler);
    set_error_handler(new ErrorHandler());
    $proteanContainerBuilder = new Builder();
    $proteanContainerBuilder->getFilesystemProperties()->setRootDirectoryPath(realpath(__DIR__ . '/../'));
    $httpBuildableDirectoryContainerBuilder = new HTTPBuildableDirectoryMap\ContainerBuilder();

    $HTTP = (new HTTP())
        ->setProteanContainerBuilder($proteanContainerBuilder)
        ->setPrefab5HTTPBuildableDirectoryMapContainerBuilder($httpBuildableDirectoryContainerBuilder)
        ->respond();

} catch (\Throwable $throwable) {
    http_response_code(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
    if (getenv('DEBUG_MODE') === 'true') {
        // open the stream just in case is not defined
        $stderr = fopen('php://stderr', 'wb');
        fwrite($stderr, $throwable->__toString() . PHP_EOL);
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
