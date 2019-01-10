<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;
use Zend\Expressive\Application;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\InvalidDirectory;

class HTTP implements HTTPInterface
{
    use Protean\Container\Builder\AwareTrait;

    public function respond(): HTTPInterface
    {
        try {
            $this->configureContainerBuilder();
            $application = $this->getProteanContainerBuilder()->build()->get(Application::class);
            $application->run();
        } catch (InvalidDirectory\Exception $e) {
            http_response_code(400);
        }

        return $this;
    }

    protected function configureContainerBuilder() : HTTPInterface
    {
        $urlRoot = explode('/', $_REQUEST['_url'])[1];
        $requestType = strtolower($_SERVER['REQUEST_METHOD']);

        $directoryMap = (new HTTPBuildableDirectoryMap())->getDirectoryMap();

        if (!isset($directoryMap[$requestType][$urlRoot])) {
            throw (new InvalidDirectory\Exception)->setCode(InvalidDirectory\Exception::CODE_INVALID_DIRECTORY);
        }

        $this->getProteanContainerBuilder()->getFilesystemProperties()->addDirectoryFilter($urlRoot);
        $this->getProteanContainerBuilder()->setCanBuildZendExpressive(true);
        $this->getProteanContainerBuilder()->setContainerName('HTTP' . $urlRoot);

        return $this;
    }
}
