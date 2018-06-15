<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV\Blip;

interface UpdateInterface
{

    public function getV1MvBlipUpdateId(): int;

    public function setV1MvBlipUpdateId(int $v1_mv_blip_update_id): UpdateInterface;

    public function getBlipId(): int;

    public function setBlipId(int $blip_id): UpdateInterface;

    public function getBlipName(): int;

    public function setBlipName(string $blip_name): UpdateInterface;

    public function getSummary(): string;

    public function setSummary(string $summary): UpdateInterface;

    public function getCreatedAt(): \DateTime;

    public function setCreatedAt(\DateTime $created_at): UpdateInterface;

    public function getRingVerb(): string;

    public function setRingVerb(string $ring_verb): UpdateInterface;

    public function getRingNumber(): int;

    public function setRingNumber(int $ring_number): UpdateInterface;
}