<?php

declare(strict_types=1);

namespace Dominion\Kingdom\Rules;

use Cerbero\Enum\Concerns\Enumerates;
use Dominion\Cards\Card;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

final class Rules
{
    private bool $includeTrash = false;
    private bool $includeBuy = false;
    private bool $test = true;

    public function __construct(private readonly Medoo $medoo) {}

    public function addSetRules(...$sets): void {}

    public function getRules(): array
    {
        return AvailableRules::names();
    }

    public function process(array $rules, Kingdom $kingdom): void
    {
        foreach ($rules as $rule) {
            $this->{$rule->name}($kingdom);
        }
    }

    public function resolveConflicts(array $rules): array
    {
        $conflictingRules = [
            [
                AvailableRules::AlwaysIncludePlatinumAndColony,
                AvailableRules::RandomIncludePlatinumAndColony,
            ],
        ];

        $keys = [];
        foreach ($conflictingRules as $ruleSet) {
            $keys[] = array_search($ruleSet, $rules);
        }

        if (count($keys) > 1) {
            unset($rules[end($keys)]);
        }

        return $rules;
    }

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function AlwaysIncludePlatinumAndColony(Kingdom $kingdom): void
    {
        if (in_array('Prosperity', $kingdom->setsInUse) === true) {
            $card = new Card($this->medoo);

            $kingdom->nonSupplyCardsListWithDetails['setup'][] = $card->getCardByName('Platinum');
            $kingdom->nonSupplyCardsListWithDetails['setup'][] = $card->getCardByName('Colony');
        }
    }

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function RandomIncludePlatinumAndColony(Kingdom $kingdom): void
    {
        $yesno = (bool) mt_rand(0, 1);
        if (in_array('Prosperity', $kingdom->setsInUse) === true && $yesno === true) {
            $card = new Card($this->medoo);

            $kingdom->nonSupplyCardsListWithDetails['setup'][] = $card->getCardByName('Platinum');
            $kingdom->nonSupplyCardsListWithDetails['setup'][] = $card->getCardByName('Colony');
        }
    }
}
