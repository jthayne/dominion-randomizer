<?php

declare(strict_types=1);

use Dominion\Cards\Card;
use Dominion\Cards\Type;
use Dominion\Cards\Validation\CardValidation;
use Dominion\CardSet;

$row = 1;
$firstRow = true;

$structure = [
    'name',
    'set',
    'types',
    'cost',
    'actions',
    'cards',
    'buys',
    'coins',
    'trash',
    'exile',
    'junk',
    'gain',
    'vp',
    'is_kingdom_card',
];

$ignoreFields = [
    'junk',
];

$setToOne = [
    'actions',
    'cards',
    'buys',
    'coins',
    'trash',
    'exile',
    'gain',
    'vp',
];

$nonKingdomCardTypes = [
    'curse',
    'project',
    'artifact',
    'state',
    'hex',
    'boon',
    'landmark',
    'event',
];

$nonKingdomCardNames = [
    'colony',
    'copper',
    'duchy',
    'estate',
    'gold',
    'platinum',
    'potion',
    'province',
    'silver',
];

$cards = [];

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

if (($handle = fopen(__DIR__ . "/cards.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($firstRow === true) {
            $firstRow = false;
            continue;
        }

        $setEdition = explode(', ', $data[1]);
        $set = $setEdition[0];
        $cards[$set][$row]['set'] = CardSet::tryFrom($set);

        foreach ($data as $key => $value) {
            switch ($structure[$key]) {
                case 'set':
                    $cards[$set][$row]['edition'] = 0;

                    $setEdition = explode(', ', $value);
                    if (count($setEdition) === 2) {
                        $edition = (int)$setEdition[1];
                        $cards[$set][$row]['edition'] = $edition;
                    }
                    break;
                case 'junk':
                case 'cost':
                    if (isset($cards[$set][$row][$structure[$key]]) === true) {
                        unset($cards[$set][$row][$structure[$key]]);
                    }
                    break;
                case 'types':
                    $types = explode(' - ', $value);

                    foreach ($types as $type) {
                        $cards[$set][$row]['types'][] = Type::tryFromName($type);
                    }

                    if (in_array(strtolower($value), $nonKingdomCardTypes) === true) {
                        $cards[$set][$row]['is_kingdom_card'] = 0;
                    }
                    break;
                case 'name':
                    $cards[$set][$row]['name'] = $value;
                    if (in_array(strtolower($value), $nonKingdomCardNames) === true) {
                        $cards[$set][$row]['is_kingdom_card'] = 0;
                    }
                    break;
                default:
                    if (empty($value) === false && in_array(strtolower($structure[$key]), $setToOne) === true) {
                        $cards[$set][$row][strtolower($structure[$key])] = 1;
                    } elseif (empty($value) === false && in_array(strtolower($structure[$key]), $ignoreFields) === false) {
                        $cards[$set][$row][strtolower($structure[$key])] = $value;
                    } else {
                        $cards[$set][$row][strtolower($structure[$key])] = 0;
                    }
            }

            if (isset($cards[$set][$row]['is_kingdom_card']) === false) {
                $cards[$set][$row]['is_kingdom_card'] = 1;
            }
        }

        $row++;
    }
    fclose($handle);

//    print_r(array_keys($cards));
//    print_r($cards['Dark Ages']);
}

$card = new Card($db);
foreach ($cards as $set => $cardlist) {
    foreach ($cardlist as $data) {
        $validatedCard = new CardValidation(
            name: $data['name'],
            set: $data['set']->value,
            edition: $data['edition'],
            isKingdomCard: $data['is_kingdom_card'],
        );

        $cardId = $card->add($validatedCard);
        foreach ($data['types'] as $type) {
            $card->addTypeToCard((int) $cardId, $type);
        }
    }
}
