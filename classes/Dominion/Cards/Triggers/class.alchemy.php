<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Alchemy
{
    use General;

    public function __construct()
    {
        $this->set = 'alchemy';
        $this->setProperName = 'Alchemy';
    }

    private function potion(): CardData
    {
        return new CardData(
            name: 'Potion',
            set: $this->setProperName,
        );
    }
}
