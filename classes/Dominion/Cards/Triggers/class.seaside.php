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
final class Seaside
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'seaside';
        $this->setProperName = 'Seaside';
    }

    private function nativevillage(): CardData
    {
        return new CardData(
            name: 'Native Village',
            set: $this->setProperName,
            mat: true,
        );
    }

    private function island(): CardData
    {
        return new CardData(
            name: 'Island',
            set: $this->setProperName,
            mat: true,
        );
    }

    private function pirateship(): CardData
    {
        return new CardData(
            name: 'Pirate Ship',
            set: $this->setProperName,
            mat: true,
        );
    }

    private function embargo(): CardData
    {
        return new CardData(
            name: 'Embargo',
            set: $this->setProperName,
            token: true,
        );
    }
}
