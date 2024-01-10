<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Menagerie
{
    use General;

    public function __construct()
    {
        $this->set = 'menagerie';
        $this->setProperName = 'Menagerie';
    }

    private function horse(): CardData
    {
        return new CardData(
            name: 'Horse',
            set: $this->setProperName,
            card: true,
        );
    }

    private function exile(): CardData
    {
        return new CardData(
            name: 'Exile',
            set: $this->setProperName,
            mat: true,
        );
    }
}
