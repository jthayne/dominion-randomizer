<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Cerbero\Enum\Concerns\Enumerates;

enum Cost
{
    use Enumerates;

    case Coin;
    case Potion;
    case Debt;
}
