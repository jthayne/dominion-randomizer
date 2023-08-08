<?php

/**
 * This header file sets up the necessary connections, etc. It should be included on all scripts.
 */

declare(strict_types=1);

use Dotenv\Dotenv;
use General\Session;

/**
 * Register The Auto Loader
 */
require_once '../vendor/autoload.php';

/**
 *--------------------------------------------------------------------------
 * Add environment variables
 *--------------------------------------------------------------------------
 */
$dotenv = Dotenv::createImmutable('../config');
$dotenv->load();

/**
 *--------------------------------------------------------------------------
 * Set up app level items. Primarily class autoload
 *--------------------------------------------------------------------------
 */
require_once '../bootstrap/autoload.php';

/**
 *--------------------------------------------------------------------------
 * Begin Session
 *--------------------------------------------------------------------------
 */
Session::create();

/**
 *--------------------------------------------------------------------------
 * Return the database schema.
 *--------------------------------------------------------------------------
 */
return include_once __DIR__ . '/../bootstrap/db.php';
