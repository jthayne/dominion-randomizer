<?php

declare(strict_types=1);

use Dominion\Cards\Cards;
use Dominion\Kingdom\Kingdom;

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

// Get initial kingdom cards.
$kingdom = new Kingdom(new Cards($db));

$kingdom->buildKingdom();

print_r($kingdom->getKingdomList());
