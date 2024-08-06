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
final class Empires
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'empires';
        $this->setProperName = 'Empires';
    }

    private function debt(): CardData
    {
        return new CardData(
            name: 'Debt',
            set: $this->setProperName,
            token: true,
        );
    }

    private function victory(): CardData
    {
        return new CardData(
            name: 'Victory Token',
            set: $this->setProperName,
            token: true,
        );
    }
}
