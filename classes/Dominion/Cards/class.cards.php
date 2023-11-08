<?php

declare(strict_types=1);

namespace Dominion\Cards;

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

    public function getRandomCard(): int
    {
        $cards = $this->getAllCards();

        return array_rand($cards);
    }

    public function getRandomKingdom(): array
    {
        $cards = $this->getAllCards();

        return array_rand($cards, 10);
    }
}
