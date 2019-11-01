<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_INVALID_YAML_FILE = self::CODE_PREFIX . 'invalid_yaml_file';
    public const CODE_BUILDABLE_DIRECTORY_FILE_NOT_FOUND = self::CODE_PREFIX . 'buildable_directory_file_not_found';
    public const CODE_FAILED_TO_WRITE_FILE = self::CODE_PREFIX . 'file_put_contents_failed';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_FAILED_TO_WRITE_FILE, 'Failed to write file.');
        $this->addPossibleMessage(self::CODE_INVALID_YAML_FILE, 'The provided yaml file could not be parsed.');
        $this->addPossibleMessage(self::CODE_BUILDABLE_DIRECTORY_FILE_NOT_FOUND, 'Buildable directory file not found at project root.');

        return $this;
    }
}
