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

    final public function addTypeToCard(int $id, CardType $type): void
    {
        $this->medoo->insert(
            'card_type',
            [
                'card_id' => $id,
                'type' => $type->name,
            ],
        );
    }
}
