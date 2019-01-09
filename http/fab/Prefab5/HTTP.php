<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;
use Zend\Expressive\Application;

class HTTP implements HTTPInterface
{
    use Protean\Container\Builder\AwareTrait;

    public function respond(): HTTPInterface
    {
        $this->configureContainerBuilder();
        $application = $this->getProteanContainerBuilder()->build()->get(Application::class);
        $application->run();

        return $this;
    }

    protected function configureContainerBuilder() : HTTPInterface
    {
        $urlRoot = explode('/', $_REQUEST['_url'])[1];

        $directory = $this->getProteanContainerBuilder()->getFilesystemProperties()->getRootDirectoryPath() . '/fab/' . $urlRoot;

        if (file_exists($directory)) {
            $this->getProteanContainerBuilder()->getFilesystemProperties()->addDirectoryFilter($urlRoot);
            $this->getProteanContainerBuilder()->setContainerName('HTTP' . $urlRoot);
        } else {
            $this->getProteanContainerBuilder()->setContainerName('HTTP');
        }

        $this->getProteanContainerBuilder()->setCanBuildZendExpressive(true);

        return $this;
    }
}
