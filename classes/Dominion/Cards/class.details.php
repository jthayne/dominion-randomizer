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
            ],
            [
                'id[=]' => $id,
            ]
        );

        if (empty($result) === false) {
            $result['set'] = CardSet::tryFromName($result['set']);
            $result['types'] = $this->getTypesForCard($id);
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
}
