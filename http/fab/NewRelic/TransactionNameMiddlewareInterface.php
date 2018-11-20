<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelic;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelicInterface;
use Psr\Http\Server\MiddlewareInterface;

interface TransactionNameMiddlewareInterface extends MiddlewareInterface
{
    public function setApplicationName(string $application_name): TransactionNameMiddlewareInterface;

    public function setNewRelic(NewRelicInterface $newRelic);
}
