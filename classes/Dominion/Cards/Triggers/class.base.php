<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

class Base
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'base';
        $this->setProperName = 'Dominion';
    }
}
