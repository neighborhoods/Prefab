<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Container\ContainerInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\InvalidDirectory;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;
use Zend\Expressive\Application;

class HTTP implements HTTPInterface
{
    use HTTPBuildableDirectoryMap\ContainerBuilder\AwareTrait;

    protected $rootDirectoryPath;

    public function respond(): HTTPInterface
    {
        try {
            $container = $this->buildContainer();
            $application = $container->get(Application::class);
            $application->run();
        } catch (InvalidDirectory\Exception | HTTP\Exception $exception) {
            http_response_code(StatusCodeInterface::STATUS_BAD_REQUEST);
            $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
            $tracer = $repository->get();
            $span = $tracer->getActiveSpan();
            if ($span !== null) {
                $span->setError($exception);
            }
        } catch (\Throwable $throwable) {
            http_response_code(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
            $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
            $tracer = $repository->get();
            $span = $tracer->getActiveSpan();
            if ($span !== null) {
                $span->setError($throwable);
            }
        }

        return $this;
    }

    protected function buildContainer(): ContainerInterface
    {
        $httpBuildableDirectoryMap = (new Opcache\HTTPBuildableDirectoryMap())->getBuildableDirectoryMap();

        // No YAML file found. Build full container
        if ($httpBuildableDirectoryMap === null) {
            return $this->getPrefab5HTTPBuildableDirectoryMapContainerBuilder()
                ->setRootDirectoryPath($this->getRootDirectoryPath())
                ->setBuildableDirectoryMap(['' => []])
                ->setDirectoryGroup('')
                ->build();
        }

        return $this->getPrefab5HTTPBuildableDirectoryMapContainerBuilder()
            ->setRootDirectoryPath($this->getRootDirectoryPath())
            ->setBuildableDirectoryMap($httpBuildableDirectoryMap)
            ->setDirectoryGroup($this->getUrlRoot())
            ->build();
    }

    protected function getUrlRoot(): string
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

    public function setRootDirectoryPath(string $rootDirectoryPath): HTTPInterface
    {
        if (isset($this->rootDirectoryPath)) {
            throw new \LogicException('Root Directory Path is already set.');
        }
        $this->rootDirectoryPath = $rootDirectoryPath;
        return $this;
    }

    private function getRootDirectoryPath(): string
    {
        if (!isset($this->rootDirectoryPath)) {
            throw new \LogicException('Root Directory Path has not been set.');
        }
        return $this->rootDirectoryPath;
    }

}
