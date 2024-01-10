<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Empires
{
    use General;

    public function __construct()
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
