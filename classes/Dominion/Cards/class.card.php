<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Dominion\Cards\Validation\CardData;
use Dominion\Cards\Validation\CardValidation;
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
                'is_split_pile' => $data->getIsSplitPile(),
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
                'is_split_pile' => $data->getIsSplitPile(),
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

    public function getCardByID(int $id): CardData
    {
        $details = $this->medoo->get(
            'cards',
            [
                'id',
                'name',
                'set',
                'edition',
                'is_kingdom_card',
                'is_split_pile',
                'total_in_kingdom [String]',
            ],
            [
                'id[=]' => $id,
            ]
        );

        $abilities = $this->medoo->select(
            'card_ability',
            'ability',
            [
                'card_id[=]' => $id,
            ],
        );

        $cost = $this->medoo->select(
            'card_cost',
            [
                'amount',
                'type',
            ],
            [
                'card_id[=]' => $id,
            ]
        );

        $trigger = $this->medoo->select(
            'card_trigger',
            'trigger',
            [
                'card_id[=]' => $id,
            ]
        );

        $type = $this->medoo->select(
            'card_type',
            'type',
            [
                'card_id[=]' => $id,
            ],
        );

        return new CardData(
            name:      $details['name'],
            set:       $details['set'],
            count:     $details['total_in_kingdom'],
            card:      true,
            kingdom:   true,
            splitPile: (bool) $details['is_split_pile'],
            types:     $type ?? [],
            cost:      $cost ?? [],
            triggers:  $trigger ?? [],
            abilities: $abilities ?? [],
        );
    }

    public function getCardByName(string $name): CardData
    {
        $details = $this->medoo->get(
            'cards',
            [
                'id',
                'name',
                'set',
                'edition',
                'is_kingdom_card',
                'total_in_kingdom [String]',
            ],
            [
                'name[=]' => $name,
            ]
        );

        $abilities = $this->medoo->select(
            'card_ability',
            'ability',
            [
                'card_id[=]' => $details['id'],
            ]
        );

        $cost = $this->medoo->select(
            'card_cost',
            [
                'amount',
                'type',
            ],
            [
                'card_id[=]' => $details['id'],
            ]
        );

        $trigger = $this->medoo->select(
            'card_trigger',
            'trigger',
            [
                'card_id[=]' => $details['id'],
            ],
        );

        $type = $this->medoo->select(
            'card_type',
            'type',
            [
                'card_id[=]' => $details['id'],
            ],
        );

        return new CardData(
            name:      $details['name'],
            set:       $details['set'],
            id:        $details['id'],
            count:     $details['total_in_kingdom'],
            card:      true,
            kingdom:   true,
            types:     $type ?? [],
            cost:      $cost ?? [],
            triggers:  $trigger ?? [],
            abilities: $abilities ?? [],
        );
    }

    /**
     * @return array<\Dominion\Cards\Validation\CardData>
     */
    public function getCardsByType(string $type): array
    {
        $cards = $this->medoo->select(
            'cards',
            [
                '[><]card_type' => ['cards.id' => 'card_id'],
            ],
            'id',
            [
                'type[=]' => $type,
            ],
        );

        $allCards = [];
        foreach ($cards as $card) {
            $allCards[] = $this->getCardByID((int) $card);
        }

        return $allCards;
    }
}
