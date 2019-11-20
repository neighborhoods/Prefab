<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface ConstantInterface extends \JsonSerializable
{


    public const PROP_NAME = 'name';
    public const PROP_VALUE = 'value';

    public function getName(): string;
    public function setName(string $name): ConstantInterface;
    public function hasName(): bool;

    public function getValue();
    public function setValue($value): ConstantInterface;
    public function hasValue(): bool;
}
