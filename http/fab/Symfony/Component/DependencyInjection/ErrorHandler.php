<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Symfony\Component\DependencyInjection;

class ErrorHandler implements ErrorHandlerInterface
{
    public function __invoke(
        int $errorNumber,
        string $errorString,
        string $errorFile,
        int $errorLine,
        array $errorContext
    ): ErrorHandlerInterface {
        throw new \ErrorException($errorString, $errorNumber, $errorNumber, $errorFile, $errorLine);
    }
}
