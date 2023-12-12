<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Cerbero\Enum\Concerns\Enumerates;

enum Type
{
    use Enumerates;

    case Action;
    case Ally;
    case Artifact;
    case Attack;
    case Augur;
    case Bane;
    case Boon;
    case Castle;
    case Clash;
    case Command;
    case Curse;
    case Debt;
    case Doom;
    case Duration;
    case Event;
    case Fate;
    case Fort;
    case Gathering;
    case Heirloom;
    case Hex;
    case Knight;
    case Landmark;
    case Liaison;
    case Loot;
    case Looter;
    case Night;
    case Odyssey;
    case Potion;
    case Prize;
    case Project;
    case Reaction;
    case Reserve;
    case Ruins;
    case Shelter;
    case Spirit;
    case State;
    case Townsfolk;
    case Trait;
    case Trash;
    case Traveller;
    case Treasure;
    case Victory;
    case Way;
    case Wizard;
    case Zombie;

}
