<?php
declare(strict_types=1);

interface PrebuilderInterface
{
    public function prebuildContainers() : PrebuilderInterface;
}
