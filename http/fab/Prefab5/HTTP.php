<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;
use Zend\Expressive\Application;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\InvalidDirectory;

class HTTP implements HTTPInterface
{
    const HTTP_CODE_BAD_REQUEST = 400;
    const HTTP_CODE_INTERNAL_ERROR = 500;
    use Protean\Container\Builder\AwareTrait;

    public function respond() : HTTPInterface
    {
        try {
            $this->configureContainerBuilder();
            $application = $this->getProteanContainerBuilder()->build()->get(Application::class);
            $application->run();
        } catch (InvalidDirectory\Exception $exception) {
            http_response_code(self::HTTP_CODE_BAD_REQUEST);
            (new NewRelic())->noticeThrowable($exception);
        } catch (HTTP\Exception $exception) {
            http_response_code(self::HTTP_CODE_BAD_REQUEST);
            (new NewRelic())->noticeThrowable($exception);
        } catch (\Throwable $throwable) {
            http_response_code(self::HTTP_CODE_INTERNAL_ERROR);
            (new NewRelic())->noticeThrowable($throwable);
        }

        return $this;
    }

    protected function configureContainerBuilder() : HTTPInterface
    {

        if (!isset($_REQUEST['_url'])) {
            throw (new HTTP\Exception())->setCode(HTTP\Exception::CODE_INVALID_ROUTE);
        }

        if (!isset($_SERVER['REQUEST_METHOD'])) {
            throw (new HTTP\Exception())->setCode(HTTP\Exception::CODE_NO_REQUEST_METHOD);
        }

        $urlArray = explode('/', $_REQUEST['_url']);

        if (!isset($urlArray[1])) {
            throw (new HTTP\Exception())->setCode(HTTP\Exception::CODE_INVALID_ROUTE);
        }

        $urlRoot = $urlArray[1];
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
