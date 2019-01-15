<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class ExceptionHandler implements ExceptionHandlerInterface
{
    public function __invoke(\Throwable $throwable): ExceptionHandlerInterface
    {
        $newRelic = new NewRelic();
        if ($newRelic->isExtensionLoaded()) {
            $newRelic->noticeThrowable($throwable);
        } else {
            fwrite(STDERR, $throwable->__toString() . PHP_EOL);
        }

        return $this;
    }
}
