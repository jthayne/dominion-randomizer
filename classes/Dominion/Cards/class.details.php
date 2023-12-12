<?php

declare(strict_types=1);

namespace Dominion\Cards;

use Dominion\CardSet;
use Medoo\Medoo;

final readonly class Details
{
    public function __construct(
        private Medoo $medoo,
    ) {
    }

    public function getByID(int $id): array {
        $result = $this->medoo->get(
            'cards',
            [
                'id',
                'name',
                'set',
                'edition',
                'is_kingdom_card',
            ],
            [
                'id[=]' => $id,
            ]
        );

        if (empty($result) === false) {
            $result['set'] = CardSet::tryFromName($result['set']);
            $result['types'] = $this->getTypesForCard($id);
            $result['abilities'] = $this->getAbilitiesForCard($id);
            $result['triggers'] = $this->getTriggersForCard($id);
        }

        return $result ?? [];
    }

    public function getTypesForCard(int $id): array
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

    public function getAbilitiesForCard(int $id): array
    {
        return $this->medoo->get(
            'card_ability',
            [
                'ability',
            ],
            [
                'card_id[=]' => $id,
            ]
        );
    }

    public function getTriggersForCard(int $id): array
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
