<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

use Symfony\Component\Finder\Finder;

class TokenReplacer implements TokenReplacerInterface
{
    protected $tokensToReplace = [];
    protected $replacementDirectory;

    public function replaceTokens() : TokenReplacerInterface
    {
        $finder = new Finder();
        $finder->files()->in($this->getReplacementDirectory());

        foreach ($finder as $file) {
            $contents = $file->getContents();
            foreach ($this->getTokensToReplace() as $token => $replacement) {
                $contents = str_replace($token, $replacement, $contents);
            }
            file_put_contents($file->getRealPath(), $contents);
        }

        return $this;
    }

    public function addNewTokenToReplace(string $token, string $replacementValue) : TokenReplacerInterface
    {
        if (isset($this->tokensToReplace[$token])) {
            throw new \LogicException('TokenReplacer token ' . $token . ' already exists');
        }

        $this->tokensToReplace[$token] = $replacementValue;
        return $this;
    }

    protected function getReplacementDirectory() : string
    {
        if ($this->replacementDirectory === null) {
            throw new \LogicException('TokenReplacer setReplacementDirectory has not been set.');
        }
        return $this->replacementDirectory;
    }

    public function setReplacementDirectory(string $replacementDirectory) : TokenReplacerInterface
    {
        if ($this->replacementDirectory !== null) {
            throw new \LogicException('TokenReplacer setReplacementDirectory is already set.');
        }
        $this->replacementDirectory = $replacementDirectory;
        return $this;
    }

    protected function getTokensToReplace() : array
    {
        if ($this->tokensToReplace === null) {
            throw new \LogicException('TokenReplacer tokensToReplace has not been set.');
        }
        return $this->tokensToReplace;
    }
}
