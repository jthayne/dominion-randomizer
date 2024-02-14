<?php

declare(strict_types=1);

namespace Dominion\Kingdom\Rules;

use Cerbero\Enum\Concerns\Enumerates;
use Cerbero\Enum\Concerns\Hydrates;

enum AvailableRules
{
    use Enumerates;

    case AlwaysIncludePlatinumAndColony;
    case RandomIncludePlatinumAndColony;
}
