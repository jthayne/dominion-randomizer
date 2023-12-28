<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;
use Dominion\Exceptions\UndefinedCardTypeException;

trait General
{
    // An array of CardData objects
    private array $addedItems = [
        'token' => [],
        'mat' => [],
        'card' => [],
    ];

    /**
     * @throws \Dominion\Exceptions\UndefinedCardTypeException
     */
    private function addItem(CardData $card): void
    {
        if ($card->isToken() === true) {
            $this->addedItems['token'][] = $card;
            return;
        }

        if ($card->isMat() === true) {
            $this->addedItems['mat'][] = $card;
            return;
        }

        if ($card->isCard() === true) {
            $this->addedItems['card'][] = $card;
            return;
        }

        throw new UndefinedCardTypeException();
    }

    final public function process(array $triggers): void
    {
        foreach ($triggers as $trigger) {
            $triggerName = $trigger;

            if (str_contains($trigger, '_') === true) {
                $triggerName = explode('_', $triggerName)[0];
            }

            $this->$triggerName($trigger);
        }
    }

    private function mat(string $matName): void
    {
        $type = $matName;

        if (str_contains($matName, '_') === true) {
            $type = explode('_', $matName)[1];
        }

        $this->$type();
    }

    private function token(string $tokenName): void
    {
        $type = $tokenName;

        if (str_contains($tokenName, '_') === true) {
            $type = explode('_', $tokenName)[1];
        }

        $this->$type();
    }

    private function upgrade(string $upgradeName): void
    {
        $type = $upgradeName;

        if (str_contains($upgradeName, '_') === true) {
            $type = explode('_', $upgradeName)[1];
        }

        $this->$type();
    }
}
