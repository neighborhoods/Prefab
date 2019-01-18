<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_COMPOSER_FILE_NOT_FOUND = self::CODE_PREFIX . 'composer_file_not_found';
    public const CODE_COMPOSER_FILE_INVALID_JSON = self::CODE_PREFIX . 'composer_file_invalid_json';
    public const CODE_FILE_PUT_CONTENTS_FAILED = self::CODE_PREFIX . 'file_put_contents_failed';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_COMPOSER_FILE_NOT_FOUND, 'No composer file found in project root');
        $this->addPossibleMessage(self::CODE_FILE_PUT_CONTENTS_FAILED, 'File put contents failed.');

        return $this;
    }
}
