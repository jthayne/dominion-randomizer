<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Cerbero\Enum\Concerns\Enumerates;

enum Abilities: int
{
    use Enumerates;

    case Actions = 1;
    case Cards = 2;
    case Buys = 4;
    case Coins = 8;
    case Trash = 16;
    case Exile = 32;
    case Gain = 64;
    case Vp = 128;
}
