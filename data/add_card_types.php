<?php

declare(strict_types=1);

use Dominion\Cards\Card;
use Dominion\Cards\Cards;
use Dominion\Cards\Details;

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

$cards = new Cards($db);
$cardList = $cards->getAllCards();

$card = new Details($db);
$cardType = new Card($db);

foreach ($cardList as $single) {
    $types = $card->getTypesForCard($single['id']);

    $typeTotal = 0;
    foreach ($types as $type) {
        $typeTotal += $type->value;
    }

    $cardType->addTypeToCard($single['id'], $typeTotal);
}
