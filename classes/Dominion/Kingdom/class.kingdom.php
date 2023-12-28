<?php

declare(strict_types=1);

namespace Dominion\Kingdom;

use Dominion\Cards\Cards;
use Random\Randomizer;

final class Kingdom
{
    private array $cardList = [];
    private array $cardListWithDetails = [];
    private array $setsInUse = [];

    public function __construct(private readonly Cards $cards) {}

    public function buildKingdom(int $size = 10): Kingdom
    {
        $this->cardList = $this->getRandomKingdom($size);

        return $this;
    }

    public function getKingdomList(): array
    {
        return $this->cardList;
    }

    public function getKingdomListWithDetails(): array
    {
        return $this->cardListWithDetails;
    }

    public function getRandomKingdom(int $size): array
    {
        $cards = $this->cards->getAllKingdomCards();

        $selectedKeys = array_rand($cards, $size);

        foreach ($selectedKeys as $key) {
            $this->cardList[] = $cards[$key];
        }

        $randomizer = new Randomizer();

        return $randomizer->shuffleArray($this->cardList);
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
