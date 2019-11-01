<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTP;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Runtime;
use Zend\ProblemDetails\Exception\ProblemDetailsExceptionInterface;

class SearchCriteriaBuilderException extends Runtime\Exception implements ProblemDetailsExceptionInterface
{
    public const CODE_PREFIX = self::class . '-';

    protected const BAD_REQUEST = "Bad Request";

    public function __construct(string $message = '')
    {
        parent::__construct()->addMessage($message);
    }

    public function getStatus() : int
    {
        return 400;
    }

    public function getType() : string
    {
        return self::BAD_REQUEST;
    }

    public function getTitle() : string
    {
        return self::BAD_REQUEST;
    }

    public function getDetail() : string
    {
        return $this->getMessage();
    }

    public function getAdditionalData() : array
    {
        return [];
    }

    /**
     * Serialize the exception to an array of problem details.
     *
     * Likely useful for the JsonSerializable implementation, but also
     * for cases where the XML variant is desired.
     */
    public function toArray() : array
    {
        return [
            $this->getStatus(),
            $this->getType(),
            $this->getTitle(),
            $this->getDetail(),
            $this->getAdditionalData()
        ];
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() : array
    {
        return [
            $this->getStatus(),
            $this->getType(),
            $this->getTitle(),
            $this->getDetail(),
            $this->getAdditionalData()
        ];
    }
}
