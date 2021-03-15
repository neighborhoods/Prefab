# Search Criteria Validators

Search Criteria Validators allow you to validate the *semantics* of the search criteria provided in a request.

## Adding Search Criteria Validators to your HTTP Handlers

### Per Application

1. Upgrade your composer dependency of Prefab to a version that includes Search Criteria Validators. //@todo include minimum versions per major version here
2. Ensure that you have resolved any discrepancies in overrides in your project's `/src/` directory for those called out in the [Modifications in `./Prefab/`](#modifications-in----prefab5--) section below.
   
### Per Handler
1. (@todo tentative) If overridden in `/src/`, update your `Handler.service.yml` file to include the modifications to the fabbed version of that file. (See the [Modifications to Actor Templates](#modifications-to-actor-templates) section below. In a future major version update of Prefab, this will need to be done for _all_ Handlers.)
2. Move the `PrimaryActorName/Map/Repository/Validator/Builder.service.yml` from `/fab/` to `/src/`. As you create Validator Decorators, you will add them to the stack of decorators in this file. They are called by the runtime from the bottom of the list to the top. The below example includes the one Validator Decorator created in [Per Decorator](#per-decorator).
> `PrimaryActorName/Map/Repository/Validator/Builder.service.yml`
>```yml
>services:
>  VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\BuilderInterface:
>    class: VendorName\ProductName\Prefab5\SearchCriteria\Validator\Builder
>    public: false
>    shared: false
>    calls:
>      - [ setValidatorFactory, ['@VendorName\ProductName\Prefab5\SearchCriteria\Validator\FactoryInterface' ] ]
>      - [ addFactory, [ '@VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\CustomDecorator\FactoryInterface']]
>```
   
### Per Decorator 
These files will all be in the `PrimaryActorName` tree. The examples below are all in `PrimaryActorName/Map/Repository/Validator/`.

#### Custom Decorator Interface and Service Container

> `CustomDecoratorInterface.php`
>```php
><?php
>declare(strict_types=1);
>
>namespace VendorName\ProductName\PrimaryActorName\Map\Repository\Validator;
>
>use VendorName\ProductName\Prefab5\SearchCriteria\Validator\DecoratorInterface;
>
>interface CustomDecoratorInterface extends DecoratorInterface
>{
>}
>```

> `CustomDecorator.service.yml`
>```yml
>services:
>  VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\CustomDecoratorInterface:
>    class: VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\CustomDecorator
>    public: false
>    shared: false
>```

#### Custom Decorator

> `CustomDecorator.php`
>```php
><?php
>declare(strict_types=1);
>
>namespace VendorName\ProductName\PrimaryActorName\Map\Repository\Validator;
>
>use VendorName\ProductName\PrimaryActorNameInterface;
>use VendorName\ProductName\Prefab5\HTTP\SearchCriteriaBuilderException;
>use VendorName\ProductName\Prefab5\SearchCriteria\ValidationException;
>use VendorName\ProductName\Prefab5\SearchCriteria\ValidatorInterface;
>use VendorName\ProductName\Prefab5\SearchCriteriaInterface;
>use VendorName\ProductName\Prefab5\SearchCriteria\Validator;
>
>final class CustomDecorator implements CustomDecoratorInterface
>{
>    use Validator\AwareTrait;
>
>    private const FIELD_INDEXES = [
>        [
>            PrimaryActorNameInterface::PROP_ID,
>        ],
>        [
>            PrimaryActorNameInterface::PROP_NAME,
>            PrimaryActorNameInterface::PROP_CREATED_AT,
>        ],
>    ];
>
>    public function validate(SearchCriteriaInterface $searchCriteria): ValidatorInterface
>    {
>        $filterFields = $this->extractFiltersFieldListFromSearchCriteria($searchCriteria);
>        $sortOrderFields = $this->extractSortOrdersFieldListFromSearchCriteria($searchCriteria);
>        $this->validateAtLeastOneIndexedFieldPresent($filterFields);
>        if (!empty($sortOrderFields)) {
>            $this->validateAtLeastOneIndexedFieldPresent($sortOrderFields);
>        }
>
>        if ($this->hasValidator()) {
>            $this->getValidator()->validate($searchCriteria);
>        }
>
>        return $this;
>    }
>
>    private function validateAtLeastOneIndexedFieldPresent(array $searchCriteriaFields): void
>    {
>        foreach (self::FIELD_INDEXES as $indexFields) {
>            if (count(array_diff($indexFields, $searchCriteriaFields)) === 0) {
>                return;
>            }
>        }
>        $errorMessage = sprintf('Invalid Search Criteria. No indexed fields present.');
>        $previousException = new SearchCriteriaBuilderException($errorMessage);
>        throw (new ValidationException())->setCode('422')->setPrevious($previousException);
>    }
>
>    private function extractFiltersFieldListFromSearchCriteria(SearchCriteriaInterface $searchCriteria) : array
>    {
>        $fieldList = [];
>
>        foreach ($searchCriteria->getFilters() as $filter) {
>            $fieldList[] = $filter->getField();
>        }
>
>        return $fieldList;
>    }
>
>    private function extractSortOrdersFieldListFromSearchCriteria(SearchCriteriaInterface $searchCriteria) : array
>    {
>        $fieldList = [];
>
>        foreach ($searchCriteria->getSortOrders() as $sortOrder) {
>            $fieldList[] = $sortOrder->getField();
>        }
>
>        return $fieldList;
>    }
>}
>```

#### Supporting Actors

> `CustomDecorator/FactoryInterface.php`
>```php
><?php
>declare(strict_types=1);
>
>namespace VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\CustomDecorator;
>
>use VendorName\ProductName\HTTP1\PropertyIdentity\Map\Repository\Validator\CustomDecoratorInterface;
>use VendorName\ProductName\Prefab5\SearchCriteria\Validator\DecoratorInterface;
>use VendorName\ProductName\Prefab5\SearchCriteria\Validator\Decorator\FactoryInterface as PrefabValidatorDecoratorFactoryInterface;
>
>interface FactoryInterface extends PrefabValidatorDecoratorFactoryInterface
>{
>    public function create(): DecoratorInterface;
>}
>```

> `CustomDecorator/Factory.service.yml`
>```yml
>services:
>  VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\CustomDecorator\FactoryInterface:
>    class: VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\CustomDecorator\Factory
>    public: false
>    shared: true
>    calls:
>      - [setPrimaryActorNameMapRepositoryValidatorCustomDecorator, ['@VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\CustomDecoratorInterface']]
>```

> `CustomDecorator/Factory.php`
>```php
><?php
>declare(strict_types=1);
>
>namespace VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\CustomDecorator;
>
>use VendorName\ProductName\PrimaryActorName\Map\Repository\Validator\CustomDecoratorInterface;
>use VendorName\ProductName\Prefab5\SearchCriteria\Validator\DecoratorInterface;
>
>class Factory implements FactoryInterface
>{
>    use AwareTrait;
>
>    public function create(): DecoratorInterface
>    {
>        return clone $this->getPrimaryActorNameMapRepositoryValidatorCustomDecorator();
>    }
>}
>```

> `CustomDecorator/AwareTrait.php`
>```php
><?php
>declare(strict_types=1);
>
>namespace VendorName\ProductName\HTTP1\PropertyIdentity\Map\Repository\Validator\CustomDecorator;
>
>use VendorName\ProductName\HTTP1\PropertyIdentity\Map\Repository\Validator\CustomDecoratorInterface;
>use VendorName\ProductName\Prefab5\SearchCriteria\Validator\DecoratorInterface;
>
>trait AwareTrait
>{
>    protected $PrimaryActorNameMapRepositoryValidatorCustomDecorator;
>
>    public function setPrimaryActorNameMapRepositoryValidatorCustomDecorator(DecoratorInterface $CustomDecorator): self
>    {
>        if ($this->hasPrimaryActorNameMapRepositoryValidatorCustomDecorator()) {
>            throw new \LogicException('PrimaryActorNameMapRepositoryValidatorCustomDecorator is already set.');
>        }
>        
>        $this->PrimaryActorNameMapRepositoryValidatorCustomDecorator = $CustomDecorator;
>
>        return $this;
>    }
>
>    protected function getPrimaryActorNameMapRepositoryValidatorCustomDecorator(): DecoratorInterface
>    {
>        if (!$this->hasPrimaryActorNameMapRepositoryValidatorCustomDecorator()) {
>            throw new \LogicException('PrimaryActorNameMapRepositoryValidatorCustomDecorator is not set.');
>        }
>
>        return $this->PrimaryActorNameMapRepositoryValidatorCustomDecorator;
>    }
>
>    protected function hasPrimaryActorNameMapRepositoryValidatorCustomDecorator(): bool
>    {
>        return isset($this->PrimaryActorNameMapRepositoryValidatorCustomDecorator);
>    }
>
>    protected function unsetPrimaryActorNameMapRepositoryValidatorCustomDecorator(): self
>    {
>        if (!$this->hasPrimaryActorNameMapRepositoryValidatorCustomDecorator()) {
>            throw new \LogicException('PrimaryActorNameMapRepositoryValidatorCustomDecorator is not set.');
>        }
>        unset($this->PrimaryActorNameMapRepositoryValidatorCustomDecorator);
>
>        return $this;
>    }
>}
>```



## Recommendations

- Create a dedicated Validator Decorator for a single logical/semantic validation need. You can and should stack multiple Validator Decorators with distinct logical/semantic validation purposes on a given Handler.
- Be sure to carefully consider the behavior of each decorator as it relates to the procession down the stack of decorators. A runtime analysis diagram and meeting is highly recommended. Generally, if a decorator is _certain_ that the request is valid without needing further validation down the stack, it may return immediately. Similarly, if a decorator is _certain_ that the request is not valid, it may throw an exception immediately. If the decorator is _not certain_ that other decorators down the stack may have more insight, it should call the next decorator in the stack.
- The last custom decorator in the stack (the first one in the list of `addDecorator` calls in the `Builder.service.yml`) should _not_ call `$this->getValidator()->validate()`. The default Validator is designed to act as a failsafe to indicate that no custom decorators were implemented for a handler.


## Modified Classes

The following classes have been modified in Prefab as part of the implementation of Search Criteria Validators. If you have overrides of these in your project's `/src/` directory, you will need to resolve any discrepancies. 

Note that in addition to those detailed below, other files were added, but should not need resolution with existing files as they are net-new.

### Modifications in `./Prefab5/`

-  `Prefab5\HTTP` has been updated to catch a `ValidationException` and respond to the request with an `HTTP 422`.
- `Prefab5\SearchCriteria` and the associated `SearchCriteria.service.yml` and `SearchCriteria\SearchCriteria.service.yml` files have been updated to handle the Validator and ValidatorFactory. 
- `Prefab5\SearchCriteria\Builder` can now access the `Validator\Builder\Factory` and validates Search Criteria.
- (@todo tentative) `Prefab5\SearchCriteria\Builder\AwareTrait`,`Prefab5\SearchCriteria\Builder\Factory\AwareTrait`,  and `Prefab5\SearchCriteria\ServerRequest\Builder\AwareTrait` have had their `unsetX` methods changed to `public` visibility.
- (@todo tentative) `Prefab5\SearchCriteria\ServerRequest\Builder` has been modified to ____________

### Modifications to Actor Templates

- (@todo tentative) `PrimaryActorName\Map\Repository\Handler` and associated `Handler.service.yml` have been updated to set and pass the `Validator\Builder\Factory` for the Handler down to the `SearchCriteria\Builder`.

## Breaking Changes

In versions 6.x and 7.x, implementing Search Criteria Validators is optional and isn't enforced by Prefab. In a future major version update of Prefab, they will be required.
Specifically, in a future major version update for Prefab,
1. the `try`/`catch` will be removed from `Prefab5\SearchCriteria\Validator::validate()`, requiring that at least one custom Validator Decorator be present per Handler, and
2. the `if ($this->hasValidatorBuilderFactory())` check will be removed from `Prefab5\SearchCriteria\Builder::validateSearchCriteria()`, requiring that each Handler define and pass a `Validator\Builder\Factory` to the `Prefab5\SearchCriteria\Builder`.


