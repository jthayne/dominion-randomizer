<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Cornucopia
{
    use General;

    public function __construct()
    {
        $this->set = 'cornucopia';
        $this->setProperName = 'Cornucopia';
    }

    private function bane(): CardData
    {
        // TODO: Add code to find and add bane card
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
