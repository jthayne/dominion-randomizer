<?php

/**
 * This header file sets up the necessary connections, etc. It should be included on all scripts.
 */

declare(strict_types=1);

use General\Environment;
use Medoo\Medoo;

/**
 *--------------------------------------------------------------------------
 * Connect to database returning the database schema.
 *--------------------------------------------------------------------------
 */
$db = new Medoo(
    [
        'type' => 'mysql',
        'host' => Environment::get('mysql_host'),
        'database' => Environment::get('mysql_database'),
        'username' => Environment::get('mysql_user'),
        'password' => Environment::get('mysql_password'),
    ],
);

return $db;
