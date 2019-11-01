<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\InvalidDirectory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_INVALID_DIRECTORY = self::CODE_PREFIX . 'invalid_directory_requested';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_INVALID_DIRECTORY, 'Invalid directory requested.');

        return $this;
    }
}
