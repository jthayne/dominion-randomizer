<?php

declare(strict_types=1);

namespace Dominion;

use Cerbero\Enum\Concerns\Enumerates;

enum CardType
{
    use Enumerates;

    case Action;
    case Ally;
    case Artifact;
    case Attack;
    case Augur;
    case Boon;
    case Castle;
    case Clash;
    case Command;
    case Curse;
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
    case Traveller;
    case Treasure;
    case Victory;
    case Way;
    case Wizard;
    case Zombie;

}
