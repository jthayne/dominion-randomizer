<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Hinterlands
{
    use General;

    public function __construct()
    {
        $this->set = 'hinterlands';
        $this->setProperName = 'Hinterlands';
    }
}
