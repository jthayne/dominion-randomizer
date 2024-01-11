<?php

declare(strict_types=1);

use Dominion\Cards\Ability;
use Dominion\Cards\Card;
use Dominion\Cards\Type;
use Dominion\Cards\Validation\CardValidation;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

$card = new Card($db);
$da = new \Dominion\Cards\Triggers\Adventures($db, $card);
print_r($da->estate());
die();
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
                    $validatedCard = new CardValidation(
                        name: $card['name'],
                        set: $cards['name'],
                        edition: $card['edition'] ?? 0,
                        isKingdomCard: $kingdomFlag,
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
                        $cardData->addType(
                            cardID: $cardID,
                            type: Type::from(ucwords($type)),
                        );
                    }

                    // Add card abilities
                    if (isset($card['ability']) === true) {
                        foreach ($card['ability'] as $ability) {
                            $cardData->addAbility(
                                cardID: $cardID,
                                ability: Ability::from(ucwords($ability)),
                            );
                        }
                    }

                    // Add card cost
                    if (isset($card['cost']) === true) {
                        foreach ($card['cost'] as $type => $cost) {
                            $cardData->addCost(
                                cardID: $cardID,
                                amount: (int) $cost,
                                type: Type::from(ucwords($type)),
                            );
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
