<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTP;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;

class Exception extends Runtime\Exception
{
    public const CODE_PREFIX = self::class . '-';
    public const CODE_INVALID_ROUTE = self::CODE_PREFIX . 'code_invalid_route';
    public const CODE_NO_REQUEST_METHOD = self::CODE_PREFIX . 'no_request_method';

    public function __construct()
    {
        parent::__construct();
        $this->addPossibleMessage(self::CODE_INVALID_ROUTE, 'Provide HTTP route is invalid.');
        $this->addPossibleMessage(self::CODE_NO_REQUEST_METHOD, 'No request method found.');

        return $this;
    }
}
