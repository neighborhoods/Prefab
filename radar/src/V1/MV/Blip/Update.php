<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV\Blip;

class Update implements UpdateInterface
{
    protected $v1_mv_blip_update_id;
    protected $blip_id;
    protected $blip_name;
    protected $summary;
    protected $created_at;
    protected $ring_verb;
    protected $ring_number;

    public function getV1MvBlipUpdateId(): int
    {
        if ($this->v1_mv_blip_update_id === null) {
            throw new \LogicException('Update v1_mv_blip_update_id has not been set.');
        }

        return $this->v1_mv_blip_update_id;
    }

    public function setV1MvBlipUpdateId(int $v1_mv_blip_update_id): UpdateInterface
    {
        if ($this->v1_mv_blip_update_id !== null) {
            throw new \LogicException('Update v1_mv_blip_update_id is already set.');
        }
        $this->v1_mv_blip_update_id = $v1_mv_blip_update_id;

        return $this;
    }

    public function getBlipId(): int
    {
        if ($this->blip_id === null) {
            throw new \LogicException('Update blip_id has not been set.');
        }

        return $this->blip_id;
    }

    public function setBlipId(int $blip_id): UpdateInterface
    {
        if ($this->blip_id !== null) {
            throw new \LogicException('Update blip_id is already set.');
        }
        $this->blip_id = $blip_id;

        return $this;
    }

    public function getBlipName(): int
    {
        if ($this->blip_name === null) {
            throw new \LogicException('Update blip_name has not been set.');
        }

        return $this->blip_name;
    }

    public function setBlipName(string $blip_name): UpdateInterface
    {
        if ($this->blip_name !== null) {
            throw new \LogicException('Update blip_name is already set.');
        }
        $this->blip_name = $blip_name;

        return $this;
    }

    public function getSummary(): string
    {
        if ($this->summary === null) {
            throw new \LogicException('Update summary has not been set.');
        }

        return $this->summary;
    }

    public function setSummary(string $summary): UpdateInterface
    {
        if ($this->summary !== null) {
            throw new \LogicException('Update summary is already set.');
        }
        $this->summary = $summary;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        if ($this->created_at === null) {
            throw new \LogicException('Update created_at has not been set.');
        }

        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): UpdateInterface
    {
        if ($this->created_at !== null) {
            throw new \LogicException('Update created_at is already set.');
        }
        $this->created_at = $created_at;

        return $this;
    }

    public function getRingVerb(): string
    {
        if ($this->ring_verb === null) {
            throw new \LogicException('Update ring_verb has not been set.');
        }

        return $this->ring_verb;
    }

    public function setRingVerb(string $ring_verb): UpdateInterface
    {
        if ($this->ring_verb !== null) {
            throw new \LogicException('Update ring_verb is already set.');
        }
        $this->ring_verb = $ring_verb;

        return $this;
    }

    public function getRingNumber(): int
    {
        if ($this->ring_number === null) {
            throw new \LogicException('Update ring_number has not been set.');
        }

        return $this->ring_number;
    }

    public function setRingNumber(int $ring_number): UpdateInterface
    {
        if ($this->ring_number !== null) {
            throw new \LogicException('Update ring_number is already set.');
        }
        $this->ring_number = $ring_number;

        return $this;
    }
}