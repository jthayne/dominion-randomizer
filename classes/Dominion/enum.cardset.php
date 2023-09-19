<?php

declare(strict_types=1);

namespace Dominion;

use Cerbero\Enum\Concerns\Enumerates;

enum CardSet: string
{
    use Enumerates;

    case Adventures = 'Adventures';
    case Alchemy = 'Alchemy';
    case Allies = 'Allies';
    case Base = 'Base';
    case Cornucopia = 'Cornucopia';
    case DarkAges = 'Dark Ages';
    case Empires = 'Empires';
    case Guilds = 'Guilds';
    case Hinterlands = 'Hinterlands';
    case Intrigue = 'Intrigue';
    case Menagerie = 'Menagerie';
    case Nocturne = 'Nocturne';
    case Plunder = 'Plunder';
    case Promo = 'Promo';
    case Prosperity = 'Prosperity';
    case Renaissance = 'Renaissance';
    case Seaside = 'Seaside';


}
