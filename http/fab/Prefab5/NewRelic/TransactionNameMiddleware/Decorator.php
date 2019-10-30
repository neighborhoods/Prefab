<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddleware;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddlewareInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelicInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Decorator implements DecoratorInterface
{
    use NewRelic\TransactionNameMiddleware\Decorator\AwareTrait;
    use NewRelic\TransactionNameMiddleware\AwareTrait;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->hasNewRelicTransactionNameMiddlewareDecorator()) {
            $response = $this->getNewRelicTransactionNameMiddlewareDecorator()->process($request, $handler);
        } else {
            $response = $this->getNewRelicTransactionNameMiddleware()->process($request, $handler);
        }

        return $response;
    }

    public function setApplicationName(string $application_name): TransactionNameMiddlewareInterface
    {
        if ($this->hasNewRelicTransactionNameMiddlewareDecorator()) {
            $decorator = $this->getNewRelicTransactionNameMiddlewareDecorator();
            $transactionNameMiddleware = $decorator->setApplicationName($application_name);
        } else {
            $transactionNameMiddleware = $this->getNewRelicTransactionNameMiddleware();
            $transactionNameMiddleware->setApplicationName($application_name);
        }

        return $transactionNameMiddleware;
    }

    public function setNewRelic(NewRelicInterface $newRelic)
    {
        if ($this->hasNewRelicTransactionNameMiddlewareDecorator()) {
            $this->getNewRelicTransactionNameMiddlewareDecorator()->setNewRelic($newRelic);
        } else {
            $this->getNewRelicTransactionNameMiddleware()->setNewRelic($newRelic);
        }

        return $this;
    }
}
