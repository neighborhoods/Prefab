<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class ErrorHandler implements ErrorHandlerInterface
{
    public function __invoke(
        int $errorNumber,
        string $errorString,
        string $errorFile,
        int $errorLine
    ): ErrorHandlerInterface {
        throw new \ErrorException($errorString, $errorNumber, $errorNumber, $errorFile, $errorLine);
    }
}
