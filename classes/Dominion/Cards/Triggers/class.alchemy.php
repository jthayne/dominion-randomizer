<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Alchemy
{
    use General;

    private function potion(): CardData
    {
        return new CardData(
            name: 'Potion',
            set: __CLASS__,
        );
    }
}
