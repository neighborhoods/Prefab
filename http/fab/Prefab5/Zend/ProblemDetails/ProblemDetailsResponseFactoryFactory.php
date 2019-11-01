<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\ProblemDetails;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\ProblemDetails\ProblemDetailsResponseFactory;

class ProblemDetailsResponseFactoryFactory implements ProblemDetailsResponseFactoryFactoryInterface
{
    protected $debug;

    public function __invoke(ContainerInterface $container) : ProblemDetailsResponseFactory
    {
        $debug = getenv('DEBUG_MODE') === 'true' ? true : false;

        $includeThrowableDetail = $debug;

        return new ProblemDetailsResponseFactory(
            $container->get(ResponseInterface::class),
            $debug,
            null,
            $includeThrowableDetail
        );
    }
}
