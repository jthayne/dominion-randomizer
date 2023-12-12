<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Dominion\CardSet;
use Medoo\Medoo;

readonly class Details
{
    public function __construct(
        private Medoo $medoo,
    ) {
    }

    final public function getByID(int $id): array {
        $result = $this->medoo->get(
            'cards',
            [
                'id',
                'name',
                'set',
                'edition',
                'is_kingdom_card',
                'cost',
                'types',
            ],
            [
                'id[=]' => $id,
            ]
        );

        if (empty($result) === false) {
            $result['set'] = CardSet::tryFromName($result['set']);
            $result['types'] = $this->getTypesForCard($id);
            $result['abilities'] = $this->getAbilitiesForCard($id);
            $result['ability_score'] = $this->calculateAbilityBinaryScore($result['abilities']);
            $result['triggers'] = $this->getTriggersForCard($id);
        }

        return $result ?? [];
    }

    final public function getTypesForCard(int $id): array
    {
        $return = [];
        $result = $this->medoo->select(
            'card_type',
            [
                'type',
            ],
            [
                'card_id[=]' => $id,
            ]
        );

        if (is_array($result) === true) {
            foreach ($result as $type) {
                $return[] = Type::tryFromName($type['type']);
            }
        }

        return $return;
    }

    final public function getAbilitiesForCard(int $id): array
    {
        return $this->medoo->get(
            'cards',
            [
                'actions',
                'cards',
                'buys',
                'coins',
                'trash',
                'exile',
                'gain',
                'vp',
            ],
            [
                'id[=]' => $id,
            ]
        );
    }

    final public function getTriggersForCard(int $id): array
    {
        $triggers = $this->medoo->select(
            'card_trigger',
            [
                'trigger',
            ],
            [
                'card_id[=]' => $id,
            ]
        );

        return unserialize($triggers['triggers']);
    }
}
