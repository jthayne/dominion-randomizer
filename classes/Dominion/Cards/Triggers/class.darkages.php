<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

final class DarkAges
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'darkages';
        $this->setProperName = 'Dark Ages';
    }

    private function spoils(): CardData
    {
        return $this->card->getCardByName('Spoils');
    }

    public function mercenary(): CardData
    {
        return $this->card->getCardByName('Mercenary');
    }

    private function ruins(): CardData
    {
        return new CardData(
            name: 'Ruins',
            set: $this->setProperName,
            card: true,
        );
    }

    private function madman(): CardData
    {
        return $this->card->getCardByName('Madman');
    }
}
