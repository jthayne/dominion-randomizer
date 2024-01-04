<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

final class Adventures
{
    use General;

    public function __construct()
    {
        $this->set = 'adventures';
        $this->setProperName = 'Adventures';
    }

    private function champion(): CardData
    {
        // TODO: Add champion upgrade code
    }

    private function disciple(): CardData
    {
        // TODO: Add disciple upgrade code
    }

    private function estate(): CardData
    {
        return new CardData(
            name: 'Estate',
            set: __CLASS__,
            token: true,
        );
    }

    private function fugitive(): CardData
    {
        // TODO: Add fugitive upgrade code
    }

    private function hero(): CardData
    {
        // TODO: Add hero upgrade code
    }

    private function journey(): CardData
    {
        return new CardData(
            name: 'Journey',
            set: __CLASS__,
            token: true,
        );
    }

    private function minscost(): CardData
    {
        return new CardData(
            name: 'Minus Cost',
            set: __CLASS__,
            token: true,
        );
    }

    private function minuscard(): CardData
    {
        return new CardData(
            name: 'Minus Card',
            set: __CLASS__,
            token: true,
        );
    }

    private function minuscoin(): CardData
    {
        return new CardData(
            name: 'Minus Coin',
            set: __CLASS__,
            token: true,
        );
    }

    private function plusaction(): CardData
    {
        return new CardData(
            name: 'Plus Action',
            set: __CLASS__,
            token: true,
        );
    }

    private function plusbuy(): CardData
    {
        return new CardData(
            name: 'Plus Buy',
            set: __CLASS__,
            token: true,
        );
    }

    private function pluscard(): CardData
    {
        return new CardData(
            name: 'Plus Card',
            set: __CLASS__,
            token: true,
        );
    }

    private function pluscoin(): CardData
    {
        return new CardData(
            name: 'Plus Coin',
            set: __CLASS__,
            token: true,
        );
    }

    private function soldier(): CardData
    {
        // TODO: Add soldier upgrade code
    }

    private function tavern(): CardData
    {
        return new CardData(
            name: 'Tavern',
            set: __CLASS__,
            mat: true,
        );
    }

    private function teacher(): CardData
    {
        // TODO: Add teacher upgrade code
    }

    private function trashing(): CardData
    {
        return new CardData(
            name: 'Trashing',
            set: __CLASS__,
            token: true,
        );
    }

    private function treasurehunter(): CardData
    {
        // TODO: Add treasure hunter upgrade code
    }

    private function warrior(): CardData
    {
        // TODO: Add warrior upgrade code
    }
}
