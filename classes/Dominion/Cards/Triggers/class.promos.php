<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Cards;

class Promos
{
    use General;

    public function __construct()
    {
        $this->set = 'promos';
        $this->setProperName = 'Promos';
    }

    private function blackmarket(int $marketsize = 15): array
    {
        // TODO: Build Black Market Deck code goes here.
    }
}
