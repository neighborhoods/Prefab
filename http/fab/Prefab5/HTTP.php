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

        $urlArray = explode('/', $_REQUEST['_url']);

        if (!isset($urlArray[1])) {
            throw (new HTTP\Exception())->setCode(HTTP\Exception::CODE_INVALID_ROUTE);
        }

        $urlRoot = $urlArray[1];

        $httpBuildableDirectoryMap = (new HTTPBuildableDirectoryMap())->getBuildableDirectoryMap();

        if (!isset($httpBuildableDirectoryMap[$urlRoot])) {
            throw (new InvalidDirectory\Exception)->setCode(InvalidDirectory\Exception::CODE_INVALID_DIRECTORY);
        }

        $this->getProteanContainerBuilder()->buildZendExpressive();
        $this->getProteanContainerBuilder()->setContainerName('HTTP_' . $urlRoot);

        foreach ($httpBuildableDirectoryMap[$urlRoot]['buildable_directories'] as $directory) {
            $this->getProteanContainerBuilder()
                ->getDiscoverableDirectories()
                ->addDirectoryPathFilter($directory);
        }

        foreach ($httpBuildableDirectoryMap[$urlRoot]['welcome_baskets'] as $welcomeBasket) {
            $this->getProteanContainerBuilder()
                ->getDiscoverableDirectories()
                ->getWelcomeBaskets()
                ->addWelcomeBasket($welcomeBasket);
        }

        foreach ($httpBuildableDirectoryMap[$urlRoot]['appended_paths'] as $path) {
            $this->getProteanContainerBuilder()->getDiscoverableDirectories()->appendPath($path);
        }

        return $this;
    }
}
