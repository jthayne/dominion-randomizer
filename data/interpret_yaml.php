<?php

declare(strict_types=1);

use Dominion\Cards\Ability;
use Dominion\Cards\Card;
use Dominion\Cards\Type;
use Dominion\Cards\Validation\CardValidation;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/../bootstrap/init.php';
$db = require __DIR__ . '/../bootstrap/db.php';

//$card = new Card($db);
//$da = new \Dominion\Cards\Triggers\Adventures($db, $card);
//print_r($da->estate());
//die();
$directory = __DIR__ . '/sets';
$sets = scandir($directory);

$cardData = new Card($db);

$triggers = [];
foreach ($sets as $set) {
    if ($set !== '.' && $set !== '..') {
        echo 'Processing ' . $set;

        $processed = $db->get(
            'files_processed',
            [
                'name',
            ],
            [
                'name[=]' => $set
            ]
        );

        if (empty($processed) === false) {
            echo ' (already processed)' . PHP_EOL;
            continue;
        }

        $cardsYaml = file_get_contents(__DIR__ . '/sets/' . $set);
        $cards = Yaml::parse($cardsYaml);

        $sections = [];
        foreach ($cards as $section => $details) {
            echo ' . ';
            if ($section !== 'name') {
                if (is_array($details) === false) {
                    var_dump($section);
                    var_dump($details);
                    die();
                }

                $kingdomFlag = 0;
                if ($section === 'cards') {
                    $kingdomFlag = 1;
                }

                foreach ($details as $card) {
                    $splitPileFlag = 0;
                    if (isset($card['split']) === true && $card['split'] === true) {
                        $splitPileFlag = 1;
                    }

                    $validatedCard = new CardValidation(
                        name: $card['name'],
                        set: $cards['name'],
                        edition: $card['edition'] ?? 0,
                        isKingdomCard: $kingdomFlag,
                        isSplitPile: $splitPileFlag,
                    );

                    $cardID = $cardData->add($validatedCard);

                    if ($cardID === 0) {
                        continue;
                    }

                    // Add card triggers
                    if (isset($card['trigger']) === true) {
                        foreach ($card['trigger'] as $trigger) {
                            $cardData->addTrigger(
                                cardID: $cardID,
                                trigger: $trigger,
                            );
                        }
                    }

                    // Add card types
                    if (isset($card['type']) === false) {
                        var_dump($card);
                        die();
                    }
                    foreach ($card['type'] as $type) {
                        $type
                            |> ucwords(...)
                            |> Type::from(...)
                            |> (static fn($x) => $cardData->addType(cardID: $cardID, type: $x,));
                    }

                    // Add card abilities
                    if (isset($card['ability']) === true) {
                        foreach ($card['ability'] as $ability) {
                            $ability
                                |> ucwords(...)
                                |> Ability::from(...)
                                |> (static fn($x) => $cardData->addAbility(cardID: $cardID, ability: $x,));
                        }
                    }

                    // Add card cost
                    if (isset($card['cost']) === true) {
                        foreach ($card['cost'] as $type => $cost) {
                            $type
                                |> ucwords(...)
                                |> Type::from(...)
                                |> (static fn($x) => $cardData->addCost(cardID: $cardID, amount: (int) $cost, type: $x,));
                        }
                    }
                }
            }
        }
        echo 'Done.' . PHP_EOL;

        $db->insert(
            'files_processed',
            [
                'name' => $set,
            ]
        );
    }
}
