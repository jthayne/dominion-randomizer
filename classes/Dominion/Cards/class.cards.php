<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Dominion\Cards\Validation\CardData;
use Medoo\Medoo;

final readonly class Cards
{
    public function __construct(
        private Medoo $medoo,
    ) {
    }

    public function getAllCards(): array
    {
        return $this->medoo->select(
            'cards',
            [
                'id',
                'name',
            ]
        );
    }

    public function getAllKingdomCards(): array
    {
        return $this->medoo->select(
            'cards',
            [
                'id',
                'name',
            ],
            [
                'is_kingdom_card[=]' => 1,
            ]
        );
    }

    public function getRandomCard(): CardData
    {
        $cards = $this->getAllCards();

        $cardID = $cards[array_rand($cards)];

        $card = new Card($this->medoo);

        return $card->getCardByID($cardID);
    }
}
