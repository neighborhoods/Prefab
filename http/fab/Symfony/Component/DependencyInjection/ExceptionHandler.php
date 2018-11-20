<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Symfony\Component\DependencyInjection;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelic;

class ExceptionHandler implements ExceptionHandlerInterface
{
    public function __invoke(\Throwable $throwable): ExceptionHandlerInterface
    {
        (new NewRelic())->noticeThrowable($throwable);

        return $this;
    }
}
