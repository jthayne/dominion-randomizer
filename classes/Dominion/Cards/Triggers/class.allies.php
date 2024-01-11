<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

class Allies
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
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
        return $this->card->getCardByName('Ally');
    }
}
