<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Cards;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

class Cornucopia
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'cornucopia';
        $this->setProperName = 'Cornucopia';
    }

    private function bane(): CardData
    {
        $cards = new Cards($this->db);

        do {
            $bane = $cards->getRandomKingdomCard();
        } while (in_array($bane->getId(), $this->kingdom->getKingdomList()) === true);

        return $bane;
    }

    /**
     * @return array<\Dominion\Cards\Validation\CardData>
     */
    private function prize(): array
    {
        $details = $this->getCardGroupDetails('prizes');

        $return = [];

        foreach ($details as $card) {
            $return[] = new CardData(
                name: $card['name'],
                set: $this->setProperName,
                card: true,
                types: $card['type'],
                cost: $card['cost'],
                abilities: $card['ability'],
            );
        }

        return $return;
    }
}
