<?php

declare(strict_types=1);

use Dominion\Cards\Cards;
use Dominion\Cards\Details;
use Dominion\Cards\Type;

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

$cards = new Cards($db);
$cardList = $cards->getAllCards();

$card = new Details($db);
//$cardType = new Type($db);

foreach ($cardList as $single) {
    $abilities = $card->getAbilitiesForCard($single['id']);
    break;
//    $types = $card->getTypesForCard($single['id']);

//    $typeTotal = 0;
//    foreach ($types as $type) {
//        $typeTotal += $type->value;
//    }

//    $cardType->addTypeToCard($single['id'], $typeTotal);
}
