<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Cards;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

/**
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
 */
final class Promos
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
        $bmList = [
            'type' => 'blackmarket',
            'cards' => [],
        ];

        $cards = new Cards($this->db);

        for ($counter = 1; $counter <= $marketsize; $counter++) {
            $bmCard = $cards->getRandomKingdomCard();
            if ($this->kingdom->isCardIdInKingdom($bmCard->getId()) === true || $bmCard->isSplitPile() === true) {
                $counter--;
            } else {
                $bmList['cards'][] = $bmCard;
            }
        }

        return $bmList;
    }
}
