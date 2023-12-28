<?php

declare(strict_types=1);

namespace Dominion\Kingdom\Validation;

use Dominion\Cards\Validation\CardData;
use Dominion\Cards\Validation\CardValidation;

final class KingdomValidation
{
    private array $supplyCards = [];
    private array $otherCards = [];

    public function __construct(public int $size)
    {
    }

    public function addToSupply(CardData $card): void
    {
        $this->supplyCards[] = $card;
    }

    public function addOtherCard(CardData $card): void
    {
        $this->otherCards[] = $card;
    }

    public function getKingdom(): array
    {
        return [
            'supply' => $this->supplyCards,
            'other' => $this->otherCards,
        ];
    }
}
