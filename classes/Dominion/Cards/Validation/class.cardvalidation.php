<?php

declare(strict_types=1);

namespace Dominion\Cards\Validation;

final readonly class CardValidation
{
    public function __construct(
        private string $name,
        private string $set,
        private int $edition = 0,
        private int $isKingdomCard = 1,
        private int $isSplitPile = 0,
    ) {}

    public function getIsSplitPile(): int
    {
        return $this->isSplitPile;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSet(): string
    {
        return $this->set;
    }

    public function getEdition(): int
    {
        return $this->edition;
    }

    public function getIsKingdomCard(): int
    {
        return $this->isKingdomCard;
    }
}
