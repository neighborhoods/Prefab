<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\ProblemDetails\ProblemDetailsMiddleware\Log;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;

class Listener implements ListenerInterface
{
    private const LOG_FILE_PATH = __DIR__ . '/../../../../../../Logs/HTTP.log';

    public function __invoke(
        \Throwable $throwable,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ListenerInterface
    {

        if (getenv('DEBUG_MODE') === 'true') {
            if (defined('STDERR')) {
                // Should exist from a CLI context
                fwrite(STDERR, $throwable->__toString() . PHP_EOL);
            } else {
                (new Logger())
                    ->setLogFilePath(self::LOG_FILE_PATH)
                    ->critical($throwable->__toString() . PHP_EOL);
            }
        }

        return $this;
    }
}
