<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Guilds
{
    use General;

    public function __construct()
    {
        $this->set = 'guilds';
        $this->setProperName = 'Guilds';
    }

    private function coffer(): CardData
    {
        return new CardData(
            name: 'Coffer',
            set: __CLASS__,
            mat: true,
        );
    }

    private function coin(): CardData
    {
        return new CardData(
            name: 'Coin',
            set: __CLASS__,
            token: true,
        );
    }
}
