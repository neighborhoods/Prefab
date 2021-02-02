<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectories;

use LogicException;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectories;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectoriesInterface;

class Builder implements BuilderInterface
{
    protected const YAML_KEY_BUILDABLE_DIRECTORIES = 'buildable_directories';
    protected const YAML_KEY_WELCOME_BASKETS = 'welcome_baskets';
    protected const YAML_KEY_APPENDED_PATHS = 'appended_paths';

    protected $record;
    protected $directoryGroupName;

    public function build(): DiscoverableDirectoriesInterface
    {
        $discoverableDirectories = new DiscoverableDirectories();
        $discoverableDirectories->setDirectoryGroupName($this->getDirectoryGroupName());
        $record = [];
        if ($this->hasRecord()) {
            $record = $this->getRecord();
        }

        if (isset($record[self::YAML_KEY_BUILDABLE_DIRECTORIES])) {
            foreach ($record[self::YAML_KEY_BUILDABLE_DIRECTORIES] as $directory) {
                $discoverableDirectories->addDirectoryPathFilter($directory);
            }
        }

        if (isset($record[self::YAML_KEY_WELCOME_BASKETS])) {
            foreach ($record[self::YAML_KEY_WELCOME_BASKETS] as $welcomeBasket) {
                $discoverableDirectories->addWelcomeBasket($welcomeBasket);
            }
        }

        if (isset($record[self::YAML_KEY_APPENDED_PATHS])) {
            foreach ($record[self::YAML_KEY_APPENDED_PATHS] as $path) {
                $discoverableDirectories->appendPath($path);
            }
        }

        return $discoverableDirectories;
    }

    public function setRecord(array $record): BuilderInterface
    {
        if (isset($this->record)) {
            throw new LogicException('Record is already set.');
        }
        $this->record = $record;
        return $this;
    }

    public function setDirectoryGroupName(string $directoryGroupName): BuilderInterface
    {
        if (isset($this->directoryGroupName)) {
            throw new LogicException('Directory Group Name is already set.');
        }
        $this->directoryGroupName = $directoryGroupName;
        return $this;
    }

    private function getRecord(): array
    {
        if (!isset($this->record)) {
            throw new LogicException('Record has not been set.');
        }
        return $this->record;
    }

    private function getDirectoryGroupName(): string
    {
        if (!isset($this->directoryGroupName)) {
            throw new LogicException('Directory Group Name has not been set.');
        }
        return $this->directoryGroupName;
    }

    private function hasRecord(): bool
    {
        return isset($this->record);
    }
}
