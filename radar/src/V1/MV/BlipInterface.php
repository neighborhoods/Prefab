<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV;

interface BlipInterface
{
    public function getV1MvBlipId(): int;

    public function setV1MvBlipId(int $v1_mv_blip_id): BlipInterface;

    public function getBlipId(): int;

    public function setBlipId(int $blip_id): BlipInterface;

    public function getName(): string;

    public function setName(string $name): BlipInterface;

    public function getDescription(): string;

    public function setDescription(string $description): BlipInterface;

    public function getRingVerb(): string;

    public function setRingVerb(string $ring_verb): BlipInterface;

    public function getRingNumber(): int;

    public function setRingNumber(int $ring_number): BlipInterface;
}