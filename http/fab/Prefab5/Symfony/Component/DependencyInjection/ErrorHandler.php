<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Symfony\Component\DependencyInjection;

/**
 * @deprecated
 * @see \ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\ErrorHandler
 */
class ErrorHandler implements ErrorHandlerInterface
{
    public function __invoke(
        int $errorNumber,
        string $errorString,
        string $errorFile,
        int $errorLine,
        array $errorContext
    ) {
        if (!(error_reporting() & $errorNumber)) {
            return false; /* @see https://www.php.net/manual/en/language.operators.errorcontrol.php */
        }
        throw new \ErrorException($errorString, $errorNumber, $errorNumber, $errorFile, $errorLine);
    }
}
