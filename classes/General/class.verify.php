<?php

declare(strict_types=1);

namespace General;

/**
 * This class is designed to contain only methods that are used to verify other values in more complex comparisons that PHP currently allows.
 */
final class Verify
{
    /**
     * Checks to see if a multidimensional array contains only empty arrays and returns true if that is the case.
     */
    public static function arrayIsEmpty(array $array, int $level = 1): bool|array
    {
        foreach ($array as $key => $value) {
            if (is_array($value) === true) {
                $value = self::arrayIsEmpty($value, $level + 1);
            }

            if (empty($value) === true && $value !== false && $value !== 0) {
                unset($array[$key]);
            } else {
                $array[$key] = $value;
            }
        }

        if ($level === 1) {
            return empty($array);
        } else {
            return $array;
        }
    }

    public static function keyInSubarrayContainsValue(array $array, string $key, mixed $contains): bool
    {
        foreach ($array as $item) {
            if ($item[$key] === $contains) {
                return true;
            }
        }

        return false;
    }
}
