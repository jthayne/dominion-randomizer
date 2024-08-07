<?php

declare(strict_types=1);

namespace Dominion\Kingdom;

use Dominion\Cards\Card;
use Dominion\Cards\Cards;
use Dominion\Cards\Triggers\Seaside;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Rules\AvailableRules;
use General\Verify;
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
    /**
     * @var array<\Dominion\Cards\Validation\CardData>
     */
    private array $cardsInSupplyListWithDetails = [];
    private array $cardsInSupplyList = [];
    public array $nonSupplyCardsListWithDetails = [];
    private array $nonSupplyCardsList = [];
    public array $setsInUse = [];
    private int $kingdomSize = 10;
    private int $players = 2;
    private array $allowedSets = [];
    /**
     * @var array<\Dominion\Kingdom\Rules\AvailableRules>
     */
    private array $appliedRules = [];

    public function __construct(private readonly Medoo $medoo, private readonly Cards $cards) {}

    public function size(int $size): Kingdom
    {
        $this->kingdomSize = $size;

        return $this;
    }

    public function set(string $setName): Kingdom
    {
        $this->allowedSets[] = $setName;

        return $this;
    }

    public function players(int $number): Kingdom
    {
        $this->players = $number;

        return $this;
    }

    public function buildKingdom(): Kingdom
    {
        $this->buildRandomKingdom();

        $this->processTriggers();

        return $this;
    }

    public function getAllCardsInKingdom(): array
    {
        return array_merge(
            $this->getKingdomList(),
            $this->getNonSupplyCardsList(),
        );
    }

    public function isCardIdInKingdom(int $id): bool
    {
        $cards = $this->getAllCardsInKingdom();

        foreach ($cards as $card) {
            if ((int) $card['id'] === $id) {
                return true;
            }
        }

        return false;
    }
    public function buildRandomKingdom(): void
    {
        $cards = [];
        if (empty($this->allowedSets) === true) {
            $cards = $this->cards->getAllKingdomCards();
        } else {
            foreach ($this->allowedSets as $allowedSet) {
                $cards = array_merge($cards, $this->cards->getCardsInSet($allowedSet));
            }
        }

        $selectedKeys = array_rand($cards, $this->kingdomSize);

        foreach ($selectedKeys as $key) {
            $this->cardsInSupplyList[] = $cards[$key];
        }

        $randomizer = new Randomizer();

        $this->cardsInSupplyList = $randomizer->shuffleArray($this->cardsInSupplyList);
        $this->buildDetailedCardList();

        $this->addBaseSupplyCards();

        $rules = new Rules\Rules($this->medoo);
        $rules->process($this->appliedRules, $this);
    }

    public function getKingdomList(): array
    {
        return $this->cardsInSupplyList;
    }

    public function getKingdomListWithDetails(): array
    {
        return [
            'supply' => $this->cardsInSupplyListWithDetails,
            'non-supply' => $this->nonSupplyCardsListWithDetails,
        ];
    }

    public function printKingdon(): void
    {
        $generated = $this->getKingdomListWithDetails();


    }

    public function getNonSupplyCardsList(): array
    {
        return $this->nonSupplyCardsList;
    }

    public function getCardCount(array $types): ?string
    {
        if (empty(array_intersect(['Victory', 'Curse'], $types)) === true) {
            return null;
        }

        if (in_array('Curse', $types) === true) {
            return (string) ($this->players * 10 - 10);
        }

        if (in_array('Victory', $types) === true) {
            return match ($this->players) {
                2 => '8',
                3, 4 => '12',
                default => '10',
            };
        }

        return null;
    }
    private function addBaseSupplyCards(): void
    {
        $card = new Card($this->medoo);

        $baseTreasures = [
            $card->getCardByName('Copper'),
            $card->getCardByName('Silver'),
            $card->getCardByName('Gold'),
        ];

        $baseVictory = [
            $card->getCardByName('Estate'),
            $card->getCardByName('Duchy'),
            $card->getCardByName('Province'),
        ];

        if (in_array('Prosperity', $this->setsInUse) === true) {
            $baseTreasures[] = $card->getCardByName('Platinum');
            $baseVictory[] = $card->getCardByName('Colony');
        }

        $this->nonSupplyCardsListWithDetails['setup'] = array_merge($baseTreasures, $baseVictory);
    }

    public function addRule(AvailableRules $rule): Kingdom
    {
        $this->appliedRules($rule);

        return $this;
    }

    private function buildDetailedCardList(): void
    {
        $card = new Card($this->medoo);

        foreach ($this->cardsInSupplyList as $single) {
            $cardDetails = $card->getCardByID($single['id']);

            $this->setsInUse[] = $cardDetails->getSet();

            $this->cardsInSupplyListWithDetails[] = $cardDetails;
        }

        $this->setsInUse = array_unique($this->setsInUse);
    }

    private function processTriggers(): void
    {
        $card = new Card($this->medoo);

        foreach ($this->cardsInSupplyListWithDetails as $cardDetails) {
            $setName = $cardDetails->getSet();
            $cardName = $cardDetails->getName();

//            echo $cardName . ' (' . $setName . ')' . PHP_EOL;
            $set = '\Dominion\Cards\Triggers\\' . str_replace(' ', '', $setName);

            $triggers = $cardDetails->getTriggers();
            if (empty($triggers) === false) {
                $setInstance = new $set($this->medoo, $card, $this);

                $setInstance->process($triggers);
            }
        }
    }

    public function addNonSupplyCard(CardData $card, bool $blackmarket = false): bool
    {
        $category = match(true) {
            $card->isMat() => 'mat',
            $card->isToken() => 'token',
            $blackmarket => 'blackmarket',
            default => 'cards',
        };

        if (isset($this->nonSupplyCardsList[$category]) === false) {
            $this->nonSupplyCardsList[$category] = [];
        }

        if (Verify::keyInSubarrayContainsValue($this->nonSupplyCardsList[$category], 'name', $card->getName()) === false){
            $this->nonSupplyCardsList[$category][] = [
                'id' => $card->getId(),
                'name' => $card->getName(),
            ];

            $this->nonSupplyCardsListWithDetails[$category][] = $card;

            return true;
        }

        return false;
    }

    public function replaceCard(): void
    {
        // TODO: Add code to replace a card in the supply. All triggers need to be undone and new triggers run
    }
}
