<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Fig\Http\Message\StatusCodeInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;
use Zend\Expressive\Application;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\InvalidDirectory;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\BuildableDirectoryFileNotFound;

class HTTP implements HTTPInterface
{
    use Protean\Container\Builder\AwareTrait;
    use HttpBuildableDirectoryMap\ContainerBuilder\AwareTrait;

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
        try {
            $httpBuildableDirectoryMap = (new Opcache\HTTPBuildableDirectoryMap())->getBuildableDirectoryMap();
        } catch (BuildableDirectoryFileNotFound\Exception $exception) {
            // No YAML file found. Build full container
            $this->getProteanContainerBuilder()->buildZendExpressive();
            $this->getProteanContainerBuilder()->setContainerName('HTTP');
            return $this->getProteanContainerBuilder();
        }

        if (!isset($_REQUEST['_url'])) {
            throw (new HTTP\Exception())->setCode(HTTP\Exception::CODE_INVALID_ROUTE);
        }

        return $this->getPrefab5HttpBuildableDirectoryMapContainerBuilder()
            ->setProteanContainerBuilder($this->getProteanContainerBuilder())
            ->setBuildableDirectoryMap($httpBuildableDirectoryMap)
            ->setRoute($_REQUEST['_url'])
            ->getContainerBuilder();
    }


}
