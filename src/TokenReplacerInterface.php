<?php

namespace Neighborhoods\Prefab;

interface TokenReplacerInterface
{
    public function replaceTokens() : TokenReplacerInterface;

    public function addNewTokenToReplace(string $token, string $replacementValue) : TokenReplacerInterface;

    public function setReplacementDirectory(string $setReplacementDirectory) : TokenReplacerInterface;
}
