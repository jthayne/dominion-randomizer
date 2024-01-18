<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Validation\CardData;
use Dominion\Exceptions\UndefinedCardTypeException;
use General\Environment;
use Symfony\Component\Yaml\Yaml;

trait General
{
    private string $set;
    private string $setProperName;

    // An array of CardData objects
    private array $addedItems = [
        'token' => [],
        'mat' => [],
        'card' => [],
        'type' => [],
    ];

    final public function process(array $triggers): void
    {
        foreach ($triggers as $trigger) {
            $triggerName = $trigger;

            if (str_contains($trigger, '_') === true) {
                $triggerName = explode('_', $triggerName)[0];
            }
echo '<-- ' . $triggerName . ' -->';
            if ($triggerName === $trigger) {
                $return = $this->$triggerName();
            } else {
                $return = $this->$triggerName($trigger);
            }

            if (is_array($return) === true) {
                // TODO: Iterate result and add each to kingdom then continue loop
                foreach ($return as $card) {
                    $this->kingdom->addNonSupplyCard($card);
                }

                continue;
            }

            $this->kingdom->addNonSupplyCard($return);
        }
    }

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
            $this->addedItems['type'][] = $card;
            return;
        }

        throw new UndefinedCardTypeException();
    }

    private function mat(string $matName): CardData
    {
        $type = $matName;

        if (str_contains($matName, '_') === true) {
            $type = explode('_', $matName, 2)[1];
        }

        return $this->$type();
    }

    private function token(string $tokenName): CardData
    {
        $type = $tokenName;

        if (str_contains($tokenName, '_') === true) {
            $type = explode('_', $tokenName, 2)[1];
        }

        return $this->$type();
    }

    private function upgrade(string $upgradeName): CardData
    {
        $type = $upgradeName;

        if (str_contains($upgradeName, '_') === true) {
            $type = explode('_', $upgradeName, 2)[1];
        }

        return $this->$type();
    }

    private function getCardDetails(string $cardName): array
    {
        $cardsYaml = file_get_contents(Environment::get('PROJECT_DIR') . '/data/sets/' . strtolower($this->set) . '.yaml');
        $cards = Yaml::parse($cardsYaml)['cards'];

        foreach ($cards as $card) {
            if (strtolower($card['name']) === strtolower($cardName)) {
                return $card;
            }
        }

        return [];
    }

    private function getCardGroupDetails(string $section): array
    {
        $cardsYaml = file_get_contents(Environment::get('PROJECT_DIR') . '/data/sets/' . strtolower($this->set) . '.yaml');
        return Yaml::parse($cardsYaml)[$section];
    }

    private function coin(): CardData
    {
        return new CardData(
            name:  'Coin',
            set:   'Base',
            token: true,
        );
    }
}
