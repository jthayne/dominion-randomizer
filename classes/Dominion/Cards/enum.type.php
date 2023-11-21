<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Cerbero\Enum\Concerns\Enumerates;

enum Type: int
{
    use Enumerates;

    case Action = 1;
    case Ally = 2;
    case Artifact = 4;
    case Attack = 8;
    case Augur = 16;
    case Boon = 32;
    case Castle = 64;
    case Clash = 128;
    case Command = 256;
    case Curse = 512;
    case Doom = 1024;
    case Duration = 2048;
    case Event = 4096;
    case Fate = 8192;
    case Fort = 16384;
    case Gathering = 32768;
    case Heirloom = 65536;
    case Hex = 131072;
    case Knight = 262144;
    case Landmark = 524288;
    case Liaison = 1048576;
    case Loot = 2097152;
    case Looter = 4194304;
    case Night = 8388608;
    case Odyssey = 16777216;
    case Prize = 33554432;
    case Project = 67108864;
    case Reaction = 134217728;
    case Reserve = 268435456;
    case Ruins = 536870912;
    case Shelter = 1073741824;
    case Spirit = 2147483648;
    case State = 4294967296;
    case Townsfolk = 8589934592;
    case Trait = 17179869184;
    case Traveller = 34359738368;
    case Treasure = 68719476736;
    case Victory = 137438953472;
    case Way = 274877906944;
    case Wizard = 549755813888;
    case Zombie = 1099511627776;

}
