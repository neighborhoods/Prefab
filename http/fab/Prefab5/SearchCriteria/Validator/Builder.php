<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator;

use LogicException;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ValidatorInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\Decorator\FactoryInterface as DecoratorFactoryInterface;

final class Builder implements BuilderInterface
{
    use Factory\AwareTrait;

    /** @var array  */
    protected $decoratorFactories = [];

    public function build(): ValidatorInterface
    {
        $Validator = $this->getValidatorFactory()->create();

        /** @var DecoratorFactoryInterface $decoratorFactory */
        foreach ($this->decoratorFactories as $decoratorFactory) {
            $Validator = $decoratorFactory->create()->setValidator($Validator);
        }

        return $Validator;
    }

    public function addFactory(DecoratorFactoryInterface $decoratorFactory): BuilderInterface
    {
        $factoryKey = str_replace('\\', '', get_class($decoratorFactory));
        if (isset($this->decoratorFactories[$factoryKey])) {
            throw new LogicException(sprintf('Factory with key, "%s", is already set.', $factoryKey));
        }
        $this->decoratorFactories[$factoryKey] = $decoratorFactory;

        return $this;
    }
}
