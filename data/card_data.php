<?php

declare(strict_types=1);

$row = 1;
$firstRow = true;

$structure = [
    'Name',
    'Set',
    'Types',
    'Cost',
    'Text',
    'Actions/Villagers',
    'Cards',
    'Buys',
    'Coins/Coffers',
    'Trash/Return',
    'Exile',
    'Junk',
    'Gain',
    'VictoryPoints',
];

$cards = [];

if (($handle = fopen("cards.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($firstRow === true) {
            $firstRow = false;
            continue;
        }

        foreach ($data as $key => $value) {
            if (empty($value) === false) {
                $cards[$data[1]][$row][strtolower($structure[$key])] = $value;
            }
        }

//        if ($row === 6) {
//            print_r($cards);
//            break;
//        }
        $row++;
//        print_r($cards);
//        break;
//        $num = count($data);
//        echo "<p> $num fields in line $row: <br /></p>\n";
//        $row++;
//        for ($c=0; $c < $num; $c++) {
//            echo $data[$c] . "<br />\n";
//        }
    }
    fclose($handle);

    print_r(array_keys($cards));
    print_r($cards);
}
