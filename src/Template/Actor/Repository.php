<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor;

use Neighborhoods\Bradfab\Template\ActorInterface;

class Repository implements RepositoryInterface
{
    public function add(ActorInterface $Actor): RepositoryInterface
    {
        // TODO: Implement add() method.
        throw new \LogicException('Unimplemented add method.');

        return $this;
    }

    public function getByIdentity(string $identity): ActorInterface
    {
        // TODO: Implement getByIdentity() method.
        throw new \LogicException('Unimplemented get method.');

        return $Actor;
    }
}
