<?php

declare(strict_types=1);

namespace Dominion\Kingdom\Rules;

final class Rules
{
    private bool $includeTrash = false;
    private bool $includeBuy = false;
    private bool $test = true;

    public function __construct()
    {

    }
    public function addSetRules(...$sets): void
    {

    }

    public function getRules(): array
    {
        return get_class_vars(__CLASS__);
    }
}
