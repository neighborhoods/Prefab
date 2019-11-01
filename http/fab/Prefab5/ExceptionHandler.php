<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class ExceptionHandler implements ExceptionHandlerInterface
{
    use Logger\AwareTrait;

    public function __invoke(\Throwable $throwable) : ExceptionHandlerInterface
    {
        $newRelic = new NewRelic();

        if ($newRelic->isExtensionLoaded()) {
            $newRelic->noticeThrowable($throwable);
        }
        // Should exist from a CLI context
        else if (defined('STDERR')) {
            fwrite(STDERR, $throwable->__toString() . PHP_EOL);
        }
        // Writing to file is extremely slow and should never be done on Production from an HTTP context
        else if (getenv('SITE_ENVIRONMENT') === 'Local') {
            $this->getPrefab5Logger()
                ->critical($throwable->__toString() . PHP_EOL);
        }

        return $this;
    }
}
