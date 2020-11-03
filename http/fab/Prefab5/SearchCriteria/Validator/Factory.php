<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ValidatorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ValidatorInterface
    {
        return clone $this->getValidator();
    }
}
