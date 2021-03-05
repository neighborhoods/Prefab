<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

use Symfony\Component\DependencyInjection\Dumper\YamlDumper;
use Zend\Expressive\Application;

class ZendExpressiveServicesBuilder implements ZendExpressiveServicesBuilderInterface
{
    use FilesystemProperties\AwareTrait;

    public function buildDIYAMLFile(): string
    {
        $filesystemProperties = $this->getHTTPBuildableDirectoryMapFilesystemProperties();
        $initialWorkingDirectory = getcwd();
        chdir($filesystemProperties->getRootDirectoryPath());
        /** @noinspection PhpIncludeInspection */
        $zendContainerBuilder = require $filesystemProperties->getZendConfigContainerFilePath();
        $applicationServiceDefinition = $zendContainerBuilder->findDefinition(Application::class);
        /** @noinspection PhpIncludeInspection */
        (require $filesystemProperties->getPipelineFilePath())($applicationServiceDefinition);
        file_put_contents(
            $filesystemProperties->getExpressiveDIYAMLFilePath(),
            (new YamlDumper($zendContainerBuilder))->dump()
        );
        chdir($initialWorkingDirectory);
        return $filesystemProperties->getZendCacheDirectoryPath();
    }
}
