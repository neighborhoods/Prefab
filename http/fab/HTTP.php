<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Protean;
use Zend\Expressive\Application;

class HTTP implements HTTPInterface
{
    use Protean\Container\Builder\AwareTrait;

    public function respond(): HTTPInterface
    {
        $application = $this->getProteanContainerBuilder()->build()->get(Application::class);
        $application->run();

        return $this;
    }
}
