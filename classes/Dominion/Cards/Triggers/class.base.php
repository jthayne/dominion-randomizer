<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

class Base
{
    use General;

    public function __construct()
    {
        $this->set = 'base';
        $this->setProperName = 'Dominion';
    }
}
