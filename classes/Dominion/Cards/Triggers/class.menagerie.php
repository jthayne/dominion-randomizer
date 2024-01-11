<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

class Menagerie
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'menagerie';
        $this->setProperName = 'Menagerie';
    }

    private function horse(): CardData
    {
        return $this->card->getCardByName('Horse');
    }

    private function exile(): CardData
    {
        return new CardData(
            name: 'Exile',
            set: $this->setProperName,
            mat: true,
        );
    }
}
