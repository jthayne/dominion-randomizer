<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

class Plunder
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'menagerie';
        $this->setProperName = 'Menagerie';
    }

    private function loot(): CardData
    {
        $cards = $this->card->getCardsByType('loot');

        $triggers = [];
        foreach ($cards as $card) {
            $triggers = array_merge($triggers, $card->getTriggers());
        }

        $triggers = array_unique($triggers);

        return new CardData(
            name: 'Loot',
            set: $this->setProperName,
            card: true,
            triggers: $triggers,
        );
    }
}
