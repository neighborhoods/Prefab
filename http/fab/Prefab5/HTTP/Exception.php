<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTP;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_INVALID_ROUTE = self::CODE_PREFIX . 'code_invalid_route';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_INVALID_ROUTE, 'Provided HTTP route is invalid.');

        return $this;
    }
}
