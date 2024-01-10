<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;

class Intrigue
{
    use General;

    public function __construct()
    {
        $this->set = 'intrigue';
        $this->setProperName = 'Intrigue';
    }
}
