<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor;

use Neighborhoods\Bradfab\Template\ActorInterface;

interface RepositoryInterface
{
    public function add(ActorInterface $Actor): RepositoryInterface;

    public function getByIdentity(string $identity): ActorInterface;
}
