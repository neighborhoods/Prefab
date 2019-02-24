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

    const HTTP_CODE_BAD_REQUEST = 400;
    const HTTP_CODE_INTERNAL_ERROR = 500;

    public function respond() : HTTPInterface
    {
        try {
            $this->configureContainerBuilder();
            $application = $this->getProteanContainerBuilder()->build()->get(Application::class);
            $application->run();
        } catch (InvalidDirectory\Exception | HTTP\Exception $exception) {
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

        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->addDirectoryPathFilter($urlRoot);
        $this->getProteanContainerBuilder()->setCanBuildZendExpressive(true);
        $this->getProteanContainerBuilder()->setContainerName('HTTP_' . $urlRoot);
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->addDirectoryPathFilter('MV1');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->addDirectoryPathFilter('Aws');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addWelcomeBasket('Doctrine\DBAL');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addWelcomeBasket('Zend\Expressive');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addWelcomeBasket('PDO');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addWelcomeBasket('Opcache');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addWelcomeBasket('NewRelic');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addWelcomeBasket('SearchCriteria');

        $application = $this->getProteanContainerBuilder()->build()->get(Application::class);
        $application->run();

        return $this;
    }
}
