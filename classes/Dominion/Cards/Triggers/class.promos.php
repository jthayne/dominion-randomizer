<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Cards;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

class Promos
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'promos';
        $this->setProperName = 'Promos';
    }

    /**
     * @return array<\Dominion\Cards\Validation\CardData>
     */
    private function blackmarket(int $marketsize = 15): array
    {
        $bmList = [];

        $cards = new Cards($this->db);

        for ($counter = 1; $counter <= $marketsize; $counter++) {
            $bmCard = $cards->getRandomCard();
            if (in_array($bmCard->getId(), $this->kingdom->getKingdomList()) === true) {
                $counter--;
            } else {
                $bmList[] = $bmCard;
            }
        }

        return $bmList;
    }
}
