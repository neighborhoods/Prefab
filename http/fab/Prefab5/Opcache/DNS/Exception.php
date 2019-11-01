<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNS;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_GET_HOST_BY_NAME_FAILED = self::CODE_PREFIX . 'get_host_by_name_failed';
    public const CODE_FILE_PUT_CONTENTS_FAILED = self::CODE_PREFIX . 'file_put_contents_failed';
    public const CODE_RENAME_FAILED = self::CODE_PREFIX . 'rename_failed';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_GET_HOST_BY_NAME_FAILED, 'Get host by name failed.');
        $this->addPossibleMessage(self::CODE_FILE_PUT_CONTENTS_FAILED, 'File put contents failed.');
        $this->addPossibleMessage(self::CODE_RENAME_FAILED, 'Rename failed.');

        return $this;
    }
}
