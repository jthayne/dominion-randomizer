<?php

declare(strict_types=1);

namespace Dominion\Kingdom\Rules;

class Custom
{
    private int $numberOfSets;

    public function __construct() {}

    final public function list(): array
    {
        return [];
    }

    final public function setLimit(int $limit = 2): void
    {
        $this->numberOfSets = $limit;
    }

    final public function getLimit(): int
    {
        return $this->numberOfSets;
    }
}
