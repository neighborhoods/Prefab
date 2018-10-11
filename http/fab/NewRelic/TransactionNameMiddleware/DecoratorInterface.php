<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelic\TransactionNameMiddleware;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelic\TransactionNameMiddlewareInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelicInterface;

interface DecoratorInterface extends TransactionNameMiddlewareInterface
{
    public function setNewRelic(NewRelicInterface $newRelic);
}
