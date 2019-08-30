<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Symfony\Component\DependencyInjection;

/**
 * @deprecated
 * @see \Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\ExceptionHandlerInterface
 */
interface ExceptionHandlerInterface
{
    public function __invoke(\Throwable $throwable): ExceptionHandlerInterface;
}
