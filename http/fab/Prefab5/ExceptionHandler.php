<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class ExceptionHandler implements ExceptionHandlerInterface
{
    use Logger\AwareTrait;

    public function __invoke(\Throwable $throwable) : ExceptionHandlerInterface
    {
        $newRelic = new NewRelic();

        if ($newRelic->isExtensionLoaded()) {
            $newRelic->noticeThrowable($throwable);
        } else {
            $this->getPrefab5Logger()
                ->critical($throwable->__toString() . PHP_EOL);
        }

        return $this;
    }
}
