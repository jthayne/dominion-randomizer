<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

class Renaissance
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'renaissance';
        $this->setProperName = 'Renaissance';
    }

    private function lantern(): CardData
    {
        return $this->card->getCardByName('Lantern');
    }

    private function horn(): CardData
    {
        return $this->card->getCardByName('Horn');
    }

    private function coffer(): CardData
    {
        return new CardData(
            name: 'Coffer',
            set: $this->setProperName,
            mat: true,
        );
    }

    private function coin(): CardData
    {
        return new CardData(
            name: 'Coin',
            set: $this->setProperName,
            token: true,
        );
    }

    private function villager(): CardData
    {
        return new CardData(
            name: 'Villager',
            set: $this->setProperName,
            mat: true,
        );
    }

    private function flag(): CardData
    {
        return $this->card->getCardByName('Flag');
    }

    private function treasurechest(): CardData
    {
        return $this->card->getCardByName('Treasure Chest');
    }

    private function key(): CardData
    {
        return $this->card->getCardByName('Key');
    }

    private function block(): CardData
    {
        return new CardData(
            name: 'Block',
            set: $this->setProperName,
            token: true,
        );
    }
}
