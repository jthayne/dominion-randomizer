<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

/**
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
 */
final class Prosperity
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'prosperity';
        $this->setProperName = 'Prosperity';
    }

    private function victory(): CardData
    {
        return new CardData(
            name: 'Victory',
            set: $this->setProperName,
            token: true,
        );
    }

    private function traderoute(): CardData
    {
        return new CardData(
            name: 'Trade Route',
            set: $this->setProperName,
            mat: true,
        );
    }
}
