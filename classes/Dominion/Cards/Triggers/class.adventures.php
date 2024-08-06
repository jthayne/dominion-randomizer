<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

/**
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
 */
final class Adventures
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'adventures';
        $this->setProperName = 'Adventures';
    }

    private function champion(): CardData
    {
        return $this->card->getCardByName('Champion');
    }

    private function disciple(): CardData
    {
        return $this->card->getCardByName('Disciple');
    }

    private function estate(): CardData
    {
        return new CardData(
            name: 'Estate',
            set: $this->setProperName,
            token: true,
        );
    }

    private function fugitive(): CardData
    {
        return $this->card->getCardByName('Fugitive');
    }

    private function hero(): CardData
    {
        return $this->card->getCardByName('Hero');
    }

    private function journey(): CardData
    {
        return new CardData(
            name: 'Journey',
            set: $this->setProperName,
            token: true,
        );
    }

    private function minscost(): CardData
    {
        return new CardData(
            name: 'Minus Cost',
            set: $this->setProperName,
            token: true,
        );
    }

    private function minuscard(): CardData
    {
        return new CardData(
            name: 'Minus Card',
            set: $this->setProperName,
            token: true,
        );
    }

    private function minuscoin(): CardData
    {
        return new CardData(
            name: 'Minus Coin',
            set: $this->setProperName,
            token: true,
        );
    }

    private function plusaction(): CardData
    {
        return new CardData(
            name: 'Plus Action',
            set: $this->setProperName,
            token: true,
        );
    }

    private function plusbuy(): CardData
    {
        return new CardData(
            name: 'Plus Buy',
            set: $this->setProperName,
            token: true,
        );
    }

    private function pluscard(): CardData
    {
        return new CardData(
            name: 'Plus Card',
            set: $this->setProperName,
            token: true,
        );
    }

    private function pluscoin(): CardData
    {
        return new CardData(
            name: 'Plus Coin',
            set: $this->setProperName,
            token: true,
        );
    }

    private function soldier(): CardData
    {
        return $this->card->getCardByName('Soldier');
    }

    private function tavern(): CardData
    {
        return new CardData(
            name: 'Tavern',
            set: $this->setProperName,
            mat: true,
        );
    }

    private function teacher(): CardData
    {
        return $this->card->getCardByName('Teacher');
    }

    private function trashing(): CardData
    {
        return new CardData(
            name: 'Trashing',
            set: $this->setProperName,
            token: true,
        );
    }

    private function treasurehunter(): CardData
    {
        return $this->card->getCardByName('Treasure Hunter');
    }

    private function warrior(): CardData
    {
        return $this->card->getCardByName('Warrior');
    }
}
