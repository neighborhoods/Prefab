<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\NewRelic\TransactionNameMiddleware;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\NewRelic\TransactionNameMiddlewareInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\NewRelicInterface;

interface DecoratorInterface extends TransactionNameMiddlewareInterface
{
    public function setNewRelic(NewRelicInterface $newRelic);
}
