<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\BuildableDirectoryFileNotFound;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_FILE_NOT_FOUND = self::CODE_PREFIX . 'buildable_directory_file_not_found';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_FILE_NOT_FOUND, 'No buildable directory file found at project root.');

        return $this;
    }
}
