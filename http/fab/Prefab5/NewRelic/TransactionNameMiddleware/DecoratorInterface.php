<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddleware;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddlewareInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelicInterface;

interface DecoratorInterface extends TransactionNameMiddlewareInterface
{
    public function setNewRelic(NewRelicInterface $newRelic);
}
