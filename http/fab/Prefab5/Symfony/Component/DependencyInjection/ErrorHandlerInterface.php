<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Symfony\Component\DependencyInjection;

/**
 * @deprecated
 * @see \Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\ErrorHandlerInterface
 */
interface ErrorHandlerInterface
{
    public function __invoke(
        int $errorNumber,
        string $errorString,
        string $errorFile,
        int $errorLine,
        array $errorContext
    );
}
