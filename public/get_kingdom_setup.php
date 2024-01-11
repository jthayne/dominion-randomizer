<?php

declare(strict_types=1);

use Dominion\Cards\Card;
use Dominion\Cards\Cards;
use Dominion\Cards\Details;
use Dominion\Kingdom\Kingdom;

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

// Get initial kingdom cards.
$kingdom = new Kingdom($db, new Cards($db));

$kingdom->buildKingdom();

$cardData = new Details($db);

$detailedList = [];
$cardList = $kingdom->getKingdomList();
foreach ($cardList as $index => $card) {
    $detailedList[] = $cardData->getByID($card['id']);
}

print_r($detailedList);
