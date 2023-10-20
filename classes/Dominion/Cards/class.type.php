<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Dominion\CardType;
use Medoo\Medoo;

readonly class Type
{
    public function __construct(
        private Medoo $medoo,
    ) {
    }

    final public function addTypeToCard(int $id, int $type): void
    {
        $this->medoo->update(
            'cards',
            [
                'types' => $type,
            ],
            [
                'id[=]' => $id,
            ]
        );
    }
}
