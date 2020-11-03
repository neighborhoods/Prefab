<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ValidatorInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\Decorator\FactoryInterface as DecoratorFactoryInterface;

interface BuilderInterface
{
    public function build(): ValidatorInterface;

    public function addFactory(DecoratorFactoryInterface $decoratorFactory): BuilderInterface; /** @override */
}
