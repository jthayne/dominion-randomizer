<?php

declare(strict_types=1);

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

// Example data
$data = [
    ['Name' => 'John', 'City' => 'New York', 'Age' => 25],
    ['Name' => 'Alice', 'City' => 'San Francisco', 'Age' => 30],
    // Add more rows as needed
];

// Display the table
displayTable($data);
