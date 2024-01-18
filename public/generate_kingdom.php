<?php

declare(strict_types=1);

use Dominion\Cards\Cards;
use Dominion\Kingdom\Kingdom;

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

//$rules = new \Dominion\Kingdom\Rules\Rules();
//var_dump($rules->getRules());
//die();

$cards = new Cards($db);
$kingdom = new Kingdom($db, $cards);

$generated = $kingdom->buildKingdom(450)
    ->getKingdomListWithDetails();

print_r($generated);
