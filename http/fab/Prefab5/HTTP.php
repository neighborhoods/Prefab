<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Fig\Http\Message\StatusCodeInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;
use Zend\Expressive\Application;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\InvalidDirectory;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\BuildableDirectoryFileNotFound;

class HTTP implements HTTPInterface
{
    use Protean\Container\Builder\AwareTrait;
    use HTTPBuildableDirectoryMap\ContainerBuilder\AwareTrait;

    public function respond() : HTTPInterface
    {
        try {
            $containerBuilder = $this->getContainerBuilder();
            $application = $containerBuilder->build()->get(Application::class);
            $application->run();
        } catch (InvalidDirectory\Exception | HTTP\Exception $exception) {
            http_response_code(StatusCodeInterface::STATUS_BAD_REQUEST);
            (new NewRelic())->noticeThrowable($exception);
        } catch (\Throwable $throwable) {
            http_response_code(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
            (new NewRelic())->noticeThrowable($throwable);
        }

        return $this;
    }

    protected function getContainerBuilder() : Protean\Container\BuilderInterface
    {
        $httpBuildableDirectoryMap = (new Opcache\HTTPBuildableDirectoryMap())->getBuildableDirectoryMap();

        // No YAML file found. Build full container
        if ($httpBuildableDirectoryMap === null) {
            $this->getProteanContainerBuilder()->buildZendExpressive();
            $this->getProteanContainerBuilder()->setContainerName('HTTP');
            return $this->getProteanContainerBuilder();
        }

        return $this->getPrefab5HTTPBuildableDirectoryMapContainerBuilder()
            ->setProteanContainerBuilder($this->getProteanContainerBuilder())
            ->setBuildableDirectoryMap($httpBuildableDirectoryMap)
            ->setDirectoryGroup($this->getUrlRoot())
            ->getContainerBuilder();
    }

    protected function getUrlRoot() : string
    {
        if (!isset($_REQUEST['_url'])) {
            throw (new HTTP\Exception())->setCode(HTTP\Exception::CODE_INVALID_ROUTE);
        }

        $urlArray = explode('/', $_REQUEST['_url']);

        if (empty($urlArray[1]) || empty($urlArray[2])) {
            throw (new HTTP\Exception())->setCode(HTTP\Exception::CODE_INVALID_ROUTE);
        }

        return $urlArray[1] . '/' . $urlArray[2];
    }

}
