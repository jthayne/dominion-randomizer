<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Dominion\Cards\Validation\CardValidation;
use Dominion\CardSet;
use Medoo\Medoo;

final readonly class Card
{
    public function __construct(
        private Medoo $medoo,
    ) {
    }

    public function add(
        CardValidation $data,
    ): int {
        $exists = $this->medoo->get(
            'cards',
            [
                'id',
            ],
            [
                'name' => $data->getName(),
                'set' => $data->getSet(),
                'edition' => $data->getEdition(),
                'is_kingdom_card' => $data->getIsKingdomCard(),
            ]
        );

        if (empty($exists) === false) {
            return (int) $exists['id'];
        }

        $this->medoo->insert(
            'cards',
            [
                'name' => $data->getName(),
                'set' => $data->getSet(),
                'edition' => $data->getEdition(),
                'is_kingdom_card' => $data->getIsKingdomCard(),
            ]
        );

        return (int) $this->medoo->id();
    }

    public function addType(
        int $cardID,
        Type $type,
    ): void
    {
        $exists = $this->medoo->get(
            'card_type',
            [
                'card_id',
            ],
            [
                'card_id[=]' => $cardID,
                'type[=]' => $type->name,
            ]
        );

        if ($exists === false || $exists === null) {
            $this->medoo->insert(
                'card_type',
                [
                    'card_id' => $cardID,
                    'type' => $type->name,
                ]
            );
        }
    }

    public function addAbility(
        int $cardID,
        Ability $ability,
    ): void
    {
        $exists = $this->medoo->get(
            'card_ability',
            [
                'card_id',
            ],
            [
                'card_id[=]' => $cardID,
                'ability[=]' => $ability->name,
            ]
        );

        if ($exists === false || $exists === null) {
            $this->medoo->insert(
                'card_ability',
                [
                    'card_id' => $cardID,
                    'ability' => $ability->name,
                ]
            );
        }
    }

    public function addTrigger(
        int $cardID,
        string $trigger,
    ): void
    {
        $exists = $this->medoo->get(
            'card_trigger',
            [
                'card_id',
            ],
            [
                'card_id[=]' => $cardID,
                'trigger[=]' => $trigger,
            ]
        );

        if ($exists === false || $exists === null) {
            $this->medoo->insert(
                'card_trigger',
                [
                    'card_id' => $cardID,
                    'trigger' => $trigger,
                ]
            );
        }
    }

    public function addCost(
        int  $cardID,
        int  $amount,
        Type $type,
    ): void
    {
        $exists = $this->medoo->get(
            'card_cost',
            [
                'card_id',
            ],
            [
                'card_id[=]' => $cardID,
                'type[=]' => $type->name,
            ]
        );

        if ($exists === false || $exists === null) {
            $this->medoo->insert(
                'card_cost',
                [
                    'card_id' => $cardID,
                    'amount' => $amount,
                    'type' => $type->name,
                ]
            );
        }
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
