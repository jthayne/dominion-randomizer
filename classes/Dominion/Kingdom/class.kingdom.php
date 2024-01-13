<?php

declare(strict_types=1);

namespace Dominion\Kingdom;

use Dominion\Cards\Card;
use Dominion\Cards\Cards;
use Medoo\Medoo;
use Random\Randomizer;

/**
 * TODO: Process triggers
 * TODO: Add ability for custom rules
 * TODO: Add ability to remove unwanted cards
 * TODO: Add base supply set up
 * TODO: Add ability to define number of players
 */
final class Kingdom
{
    private array $cardList = [];
    private array $cardListWithDetails = [];
    private array $setsInUse = [];

    public function __construct(private readonly Medoo $medoo, private readonly Cards $cards) {}

    public function buildKingdom(int $size = 10): Kingdom
    {
        $this->buildRandomKingdom($size);

        return $this;
    }

    public function buildRandomKingdom(int $size): void
    {
        $cards = $this->cards->getAllKingdomCards();

        $selectedKeys = array_rand($cards, $size);

        foreach ($selectedKeys as $key) {
            $this->cardList[] = $cards[$key];
        }

        $randomizer = new Randomizer();

        $this->cardList = $randomizer->shuffleArray($this->cardList);
        $this->buildDetailedCardList();
    }

    public function getKingdomList(): array
    {
        return $this->cardList;
    }

    public function getKingdomListWithDetails(): array
    {
        return $this->cardListWithDetails;
    }

    private function buildDetailedCardList(): void
    {
        $card = new Card($this->medoo);

        foreach ($this->cardList as $single) {
            $cardDetails = $card->getCardByID($single['id']);

            $this->setsInUse[] = $cardDetails->getSet();

            $this->cardListWithDetails[] = $cardDetails;
        }

        $this->setsInUse = array_unique($this->setsInUse);
    }
}
