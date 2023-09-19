<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Dominion\CardSet;
use Medoo\Medoo;

final readonly class Card
{
    public function __construct(
        private Medoo $medoo,
    ) {
    }

    public function add(
        array $data,
    ): ?string {
        $this->medoo->insert(
            'cards',
            [
                'name' => $data['name'],
                'set' => $data['set']->value,
                'edition' => $data['edition'],
                'text' => $data['text'],
                'actions' => $data['actions'],
                'cards' => $data['cards'],
                'buys' => $data['buys'],
                'coins' => $data['coins'],
                'trash' => $data['trash'],
                'exile' => $data['exile'],
                'gain' => $data['gain'],
                'vp' => $data['vp'],
                'is_kingdom_card' => $data['is_kingdom_card'],
            ]
        );

        return $this->medoo->id();
    }
}
