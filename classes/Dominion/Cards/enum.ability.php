<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Cerbero\Enum\Concerns\Enumerates;

enum Ability
{
    use Enumerates;

    case Action;
    case Boon;
    case Buy;
    case Card;
    case Coffer;
    case Coin;
    case Curse;
    case Exile;
    case Favor;
    case Gain;
    case Hex;
    case Trash;
    case Victory;
    case Villager;
}
