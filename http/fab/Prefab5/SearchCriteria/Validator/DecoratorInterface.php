<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ValidatorInterface;

interface DecoratorInterface extends ValidatorInterface
{
    public function setValidator(ValidatorInterface $validator);
}
