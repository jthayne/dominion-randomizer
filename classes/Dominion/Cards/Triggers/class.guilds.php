<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

class Guilds
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'guilds';
        $this->setProperName = 'Guilds';
    }

    private function coffer(): CardData
    {
        return new CardData(
            name: 'Coffer',
            set: $this->setProperName,
            mat: true,
        );
    }
}
