<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

final class DarkAges
{
    use General;

    public function __construct()
    {
        $this->set = 'darkages';
        $this->setProperName = 'Dark Ages';
    }

    private function spoils(): CardData
    {
        // TODO: Add code to find and add bane card
    }

    public function mercenary(): CardData
    {
        $details = $this->getCardDetails('mercenary');

        return new CardData(
            name: $details['name'],
            set:  $this->setProperName,
            card: true,
            kingdom: $details['supply'],
            types: $details['type'],
            cost: $details['cost'],
            abilities: $details['ability'],
        );
    }

    private function ruins(): CardData
    {
        // TODO: Add code for ruins cards
    }

    private function madman(): CardData
    {
        // TODO: Add code for madman card
    }
}
