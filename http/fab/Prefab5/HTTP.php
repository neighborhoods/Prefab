<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;
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
        $requestType = strtolower($_SERVER['REQUEST_METHOD']);

        $directoryMap = (new HTTPBuildableDirectoryMap())->getDirectoryMap();

        if (!isset($directoryMap[$requestType][$urlRoot])) {
            throw new \Exception('ayy lmao');
        }

        $this->getProteanContainerBuilder()->getFilesystemProperties()->addDirectoryFilter($urlRoot);
        $this->getProteanContainerBuilder()->setCanBuildZendExpressive(true);
        $this->getProteanContainerBuilder()->setContainerName('HTTP' . $urlRoot);

        return $this;
    }
}
