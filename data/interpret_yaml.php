<?php

declare(strict_types=1);

use Dominion\Cards\Card;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

$directory = __DIR__ . '/sets';
$sets = scandir($directory);

$triggers = [
    'isReserve',
    'isArtifactSupplier',
    'isDoom',
    'isFate',
    'isLiaison',
    'isLootSupplier',
    'isVillageSupplier',
];

$cardData = new Card($db);

foreach ($sets as $set) {
    if ($set !== '.' && $set !== '..') {
        $cardsYaml = file_get_contents(__DIR__ . '/sets/' . $set);
        $cards = Yaml::parse($cardsYaml);

        foreach ($cards['cards'] as $card) {
            $cardTriggers = [];
            foreach ($card as $attribute => $bool) {
                if ($bool === true) {
                    if (in_array($attribute, $triggers) === true) {
                        $cardTriggers[] = $attribute;
                    }
                }
            }
            $cardTriggersSerial = serialize($cardTriggers);

            $details = $cardData->getCardByName($card['name']);
            if (is_null($details) === true) {
                echo 'Set: ' . $set . ' Card: ' . $card['name'] . PHP_EOL;
            } else {
                $cardId = (int) $details['id'];

                $cardData->addTriggersToCard($cardId, $cardTriggersSerial);
            }
        }
    }
}
