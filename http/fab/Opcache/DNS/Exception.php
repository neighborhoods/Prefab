<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNS;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Exception\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_GET_HOST_BY_NAME_FAILED = self::CODE_PREFIX . 'get_host_by_name_failed';
    public const CODE_FILE_PUT_CONTENTS_FAILED = self::CODE_PREFIX . 'file_put_contents_failed';
    public const CODE_RENAME_FAILED = self::CODE_PREFIX . 'rename_failed';

    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        $this->addPossibleMessage(self::CODE_GET_HOST_BY_NAME_FAILED, 'Get host by name failed.');
        $this->addPossibleMessage(self::CODE_FILE_PUT_CONTENTS_FAILED, 'File put contents failed.');
        $this->addPossibleMessage(self::CODE_RENAME_FAILED, 'Rename failed.');

        return parent::__construct($message, $code, $previous);
    }
}