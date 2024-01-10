<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Renaissance
{
    use General;

    public function __construct()
    {
        $this->set = 'renaissance';
        $this->setProperName = 'Renaissance';
    }

    private function lantern(): CardData
    {
        return new CardData(
            name: 'Lantern',
            set: $this->setProperName,
            card: true,
        );
    }

    private function horn(): CardData
    {
        return new CardData(
            name: 'Horn',
            set: $this->setProperName,
            card: true,
        );
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
        return new CardData(
            name: 'Flag',
            set: $this->setProperName,
            card: true,
        );
    }

    private function treasurechest(): CardData
    {
        return new CardData(
            name: 'Treasure Chest',
            set: $this->setProperName,
            card: true,
        );
    }

    private function key(): CardData
    {
        return new CardData(
            name: 'Key',
            set: $this->setProperName,
            card: true,
        );
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
