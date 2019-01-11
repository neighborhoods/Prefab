#set($namespacePrefix = "")
#set($truncatedClassPath = "")
#set($lastPartOfNamespace = "")
#set($daoUpper = "")
#set($daoLower = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

namespace ${NAMESPACE};

use ${namespacePrefix}Exception\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_MULTIPLE_RECORDS_RETRIEVED = self::CODE_PREFIX . 'multiple_records_retrieved';
    public const CODE_NO_DATA_LOADED = self::CODE_PREFIX . 'no_data_loaded';

    public function __construct(${DS}message = null, ${DS}code = 0, \Throwable ${DS}previous = null)
    {
        ${DS}this->addPossibleMessage(self::CODE_MULTIPLE_RECORDS_RETRIEVED, 'Multiple records retrieved.');
        ${DS}this->addPossibleMessage(self::CODE_NO_DATA_LOADED, 'No data loaded.');

        return parent::__construct(${DS}message, ${DS}code, ${DS}previous);
    }
}