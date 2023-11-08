<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Dominion\CardSet;
use Dominion\CardType;
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
                'text',
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
                $return[] = CardType::tryFromName($type['type']);
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
    final public function hasAbility(int $id, Abilities $ability): bool
    {
        $details = $this->getByID($id);

        if ($details['abilities'] & $ability->value) {
            return true;
        }

        return false;
    }

    private function calculateAbilityBinaryScore(array $abilities): int
    {
        $score = 0;

        foreach ($abilities as $ability => $flag) {
            if ($flag === 1) {
                $ability = ucfirst($ability);

                $value = Abilities::tryFromName($ability);

                $score += $value;
            }
        }

        return $score;
    }
}
