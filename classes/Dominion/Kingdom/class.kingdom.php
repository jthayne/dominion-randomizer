<?php

declare(strict_types=1);

namespace Dominion\Kingdom;

use Dominion\Cards\Cards;

final class Kingdom
{
    private array $cardList = [];
    private array $setsInUse = [];

    public function __construct(private readonly Cards $cards) {}

    public function buildKingdom(int $size = 10): void
    {
        $this->cardList = $this->getRandomKingdom($size);
    }

    public function getKingdomList(): array
    {
        return $this->cardList;
    }

    public function getRandomKingdom(int $size): array
    {
        $cards = $this->cards->getAllCards();

        return array_rand($cards, $size);
    }

    public function replaceCard(int $oldCard): void
    {
        $process = true;

        $place = array_search($oldCard, $this->cardList);

        do {
            $newCard = $this->cards->getRandomCard();

            if ($newCard !== $oldCard) {
                $this->cardList[$place] = $newCard;
                $process = false;
            }
        } while ($process === true);
    }
}
