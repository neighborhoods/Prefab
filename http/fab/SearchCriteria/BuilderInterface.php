<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteriaInterface;

interface BuilderInterface
{
    public function build(): SearchCriteriaInterface;
}