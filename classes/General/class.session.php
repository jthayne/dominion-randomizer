<?php

/** @noinspection GlobalVariableUsageInspection */

declare(strict_types=1);

namespace General;

/**
 * This class is designed to manage the session.
 */
final class Session
{
    /**
     * Starts the PHP session
     */
    public static function create(array $options = []): void
    {
        session_start($options);
    }

    /**
     * Destroys the PHP session effectively logging the user out of the system.
     */
    public static function destroy(): void
    {
        session_destroy();

        self::unset('user');
        self::unset('oauth2state');
        self::unset('oauth2pkcecode');
    }

    /**
     * Unset a single session variable.
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public static function unset(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Sets a single session variable
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Gets the value for the specified session variable. Returns null if the variable does not exist.
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public static function get(string $key): mixed
    {
        if (isset($_SESSION[$key]) === false) {
            return null;
        }

        return $_SESSION[$key];
    }

    /**
     * Gets the value for the specified session variable and returns it as a string.
     */
    public static function getString(string $key): string
    {
        return strval(self::get($key));
    }

    /**
     * Gets the value for the specified session variable and returns it as an integer.
     */
    public static function getInt(string $key): int
    {
        return (int) self::get($key);
    }
}
