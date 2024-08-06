<?php

declare(strict_types=1);

namespace Dominion\Exceptions;

use Exception;

class UndefinedCardTypeException extends Exception
{
    public function __toString(): string
    {
        if (empty($return) === false) {
            return $this->getMessage();
        }

        return 'Card type undefined in: ' . __CLASS__;
    }
}
