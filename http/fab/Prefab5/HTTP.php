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
        $this->getProteanContainerBuilder()->setCanBuildZendExpressive(true);
        $this->getProteanContainerBuilder()->setContainerName('HTTP');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->addDirectoryPathFilter('MV1');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->addDirectoryPathFilter('Aws');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addBuildableDirectory('Doctrine\DBAL');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addBuildableDirectory('Zend\Expressive');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addBuildableDirectory('PDO');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addBuildableDirectory('Opcache');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addBuildableDirectory('NewRelic');
        $this->getProteanContainerBuilder()->getDiscoverableDirectories()->getWelcomeBaskets()->addBuildableDirectory('SearchCriteria');
        $application = $this->getProteanContainerBuilder()->build()->get(Application::class);
        $application->run();

        return $this;
    }
}
