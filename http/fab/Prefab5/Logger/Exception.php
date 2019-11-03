<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_FILE_OPEN_FAILED = self::CODE_PREFIX . 'failed_to_open_file';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_FILE_OPEN_FAILED, 'Failed to open file.');

        return $this;
    }
}
