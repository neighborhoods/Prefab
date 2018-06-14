<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV;

class Blip implements BlipInterface
{
    protected $v1_mv_blip_id;
    protected $blip_id;
    protected $name;
    protected $description;
    protected $ring_verb;
    protected $ring_number;

    public function getV1MvBlipId(): int
    {
        if ($this->v1_mv_blip_id === null) {
            throw new \LogicException('Blip v1_mv_blip_id has not been set.');
        }

        return $this->v1_mv_blip_id;
    }

    public function setV1MvBlipId(int $v1_mv_blip_id): BlipInterface
    {
        if ($this->v1_mv_blip_id !== null) {
            throw new \LogicException('Blip v1_mv_blip_id is already set.');
        }
        $this->v1_mv_blip_id = $v1_mv_blip_id;

        return $this;
    }

    public function getBlipId(): int
    {
        if ($this->blip_id === null) {
            throw new \LogicException('Blip blip_id has not been set.');
        }

        return $this->blip_id;
    }

    public function setBlipId(int $blip_id): BlipInterface
    {
        if ($this->blip_id !== null) {
            throw new \LogicException('Blip blip_id is already set.');
        }
        $this->blip_id = $blip_id;

        return $this;
    }

    public function getName(): string
    {
        if ($this->name === null) {
            throw new \LogicException('Blip name has not been set.');
        }

        return $this->name;
    }

    public function setName(string $name): BlipInterface
    {
        if ($this->name !== null) {
            throw new \LogicException('Blip name is already set.');
        }
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        if ($this->description === null) {
            throw new \LogicException('Blip description has not been set.');
        }

        return $this->description;
    }

    public function setDescription(string $description): BlipInterface
    {
        if ($this->description !== null) {
            throw new \LogicException('Blip description is already set.');
        }
        $this->description = $description;

        return $this;
    }

    public function getRingVerb(): string
    {
        if ($this->ring_verb === null) {
            throw new \LogicException('Blip ring_verb has not been set.');
        }

        return $this->ring_verb;
    }

    public function setRingVerb(string $ring_verb): BlipInterface
    {
        if ($this->ring_verb !== null) {
            throw new \LogicException('Blip ring_verb is already set.');
        }
        $this->ring_verb = $ring_verb;

        return $this;
    }

    public function getRingNumber(): int
    {
        if ($this->ring_number === null) {
            throw new \LogicException('Blip ring_number has not been set.');
        }

        return $this->ring_number;
    }

    public function setRingNumber(int $ring_number): BlipInterface
    {
        if ($this->ring_number !== null) {
            throw new \LogicException('Blip ring_number is already set.');
        }
        $this->ring_number = $ring_number;

        return $this;
    }
}