<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

$cards = new Dominion\Cards\Cards($db);

$kingdom = new \Dominion\Kingdom\Kingdom($cards);

$generated = $kingdom->buildKingdom()->getKingdomListWithDetails();

print_r($generated);
