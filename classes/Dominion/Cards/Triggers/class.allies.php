<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Allies
{
    use General;

    public function __construct()
    {
        $this->set = 'allies';
        $this->setProperName = 'Allies';
    }

    private function favor(): CardData
    {
        return new CardData(
            name: 'Favor',
            set:  $this->setProperName,
            mat:  true,
        );
    }

    private function coin(): CardData
    {
        return new CardData(
            name:  'Coin',
            set:   $this->setProperName,
            token: true,
        );
    }

    private function ally(): CardData
    {
        return new CardData(
            name:  'Ally',
            set:   $this->setProperName,
            card: true,
        );
    }
}
