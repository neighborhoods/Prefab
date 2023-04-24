<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use Neighborhoods\ExceptionComponent\Exception;
use Mezzio\ProblemDetails\Exception\CommonProblemDetailsExceptionTrait;

final class ValidationException extends Exception implements ValidationExceptionInterface
{
    use CommonProblemDetailsExceptionTrait;

    private const STATUS_CODE = 422;
    private const STATUS_TITLE = 'Unprocessable Entity';
    private const STATUS_TYPE = 'https://httpstatuses.com/422';

    public function __construct()
    {
        parent::__construct();
        $this->status = self::STATUS_CODE;
        $this->title = self::STATUS_TITLE;
        $this->type = self::STATUS_TYPE;
    }

    public function getDetail(): string
    {
        $messages  = [];
        if (!empty($this->getMessage())) {
            $messages[] = $this->getMessage();
        }
        $messages = array_merge($messages, $this->getMessages());
        return implode('; ', $messages);
    }
}
