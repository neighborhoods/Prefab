<?php

namespace Neighborhoods\Prefab;

interface PrefabInterface
{
    public function generate() : PrefabInterface;
}
