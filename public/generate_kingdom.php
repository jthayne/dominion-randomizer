<?php

declare(strict_types=1);

use Dominion\Cards\Cards;
use Dominion\Kingdom\Kingdom;

require_once __DIR__ . '/../bootstrap/init.php';
$db = require_once __DIR__ . '/../bootstrap/db.php';

$cards = new Cards($db);
$kingdom = new Kingdom($db, $cards);

$generated = $kingdom->size(10)
    ->set('Nocturne')
    ->set('Menagerie')
    ->set('Prosperity')
    ->buildKingdom()
    ->getKingdomListWithDetails();

function displayTable($data): void
{
    // Check if data is not empty
    if (empty($data)) {
        echo 'No data to display.' . PHP_EOL;
        return;
    }

    // Get the column headers from the first row
    $headers = array_keys($data[0]);

    // Calculate the maximum width for each column
    $columnWidths = [];
    foreach ($headers as $header) {
        $columnWidths[$header] = strlen($header);
    }

    foreach ($data as $row) {
        foreach ($row as $key => $value) {
            $columnWidths[$key] = max($columnWidths[$key], strlen($value));
        }
    }

    // Display the headers
    foreach ($headers as $header) {
        echo str_pad($header, $columnWidths[$header] + 2);
    }
    echo PHP_EOL;

    // Display a horizontal line
    foreach ($columnWidths as $width) {
        echo str_repeat('-', $width + 2);
    }
    echo PHP_EOL;

    // Display the data rows
    foreach ($data as $row) {
        foreach ($row as $key => $value) {
            echo str_pad($value, $columnWidths[$key] + 2);
        }
        echo PHP_EOL;
    }
}

$toAdd = [];
foreach ($generated['supply'] as $item) {
    $toAdd[] = [
        'Kingdom' => $item->getName(),
        'Set' => $item->getSet(),
    ];
}

displayTable($toAdd);
echo PHP_EOL;

foreach ($generated['non-supply'] as $index => $item) {
    $toAdd = [];

    foreach ($item as $value) {
        $toAdd[] = [
            ucwords($index) => $value->getName(),
            'Set' => $value->getSet(),
        ];
    }

    displayTable($toAdd);
    echo PHP_EOL;
}
//foreach ($generated as $item) {

//}
//displayTable($generated);
//print_r($generated);
