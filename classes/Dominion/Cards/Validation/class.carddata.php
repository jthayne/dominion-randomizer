<?php

declare(strict_types=1);

namespace Dominion\Cards\Validation;

final readonly class CardData
{
    public function __construct(
        private string $name,
        private string $set,
        private int    $id = 0,
        private bool   $card = false,
        private bool   $mat = false,
        private bool   $token = false,
        private bool   $kingdom = false,
        private bool   $splitPile = false,
        private array  $types = [],
        private array  $cost = [],
        private array  $triggers = [],
        private array  $abilities = [],
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSet(): string
    {
        return $this->set;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function getCost(): array
    {
        return $this->cost;
    }

    public function getTriggers(): array
    {
        return $this->triggers;
    }

    public function getAbilities(): array
    {
        return $this->abilities;
    }

    public function isSplitPile(): bool
    {
        return $this->splitPile;
    }

    public function isCard(): bool
    {
        return $this->card;
    }

    public function isMat(): bool
    {
        return $this->mat;
    }

    public function isKingdom(): bool
    {
        return $this->kingdom;
    }

    public function isToken(): bool
    {
        return $this->token;
    }
}
