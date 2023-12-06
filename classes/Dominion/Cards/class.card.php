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
                'actions' => $data['actions'],
                'cards' => $data['cards'],
                'buys' => $data['buys'],
                'coins' => $data['coins'],
                'trash' => $data['trash'],
                'exile' => $data['exile'],
                'gain' => $data['gain'],
                'vp' => $data['vp'],
                'is_kingdom_card' => $data['is_kingdom_card'],
                'triggers' => $data['triggers'],
            ]
        );

        return $this->medoo->id();
    }

    public function addTypeToCard(int $id, int $type): void
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

    public function addTriggersToCard(int $id, string $triggers): void
    {
        $this->medoo->update(
            'cards',
            [
                'triggers' => $triggers,
            ],
            [
                'id[=]' => $id,
            ],
        );
    }

    public function getCardByName(string $name): ?array
    {
        return $this->medoo->get(
            'cards',
            [
                'id',
                'name',
                'set',
                'edition',
                'actions',
                'cards',
                'buys',
                'coins',
                'trash',
                'exile',
                'gain',
                'vp',
                'is_kingdom_card',
                'triggers',
            ],
            [
                'name[=]' => $name,
            ]
        );
    }
}
