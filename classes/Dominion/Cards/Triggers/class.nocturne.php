<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

/**
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
 */
final class Nocturne
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'nocturne';
        $this->setProperName = 'Nocturne';
    }

    private function bat(): CardData
    {
        return $this->card->getCardByName('Bat');
    }

    private function boon(): CardData
    {
        $cards = $this->card->getCardsByType('hex');

        $triggers = [];
        foreach ($cards as $card) {
            $triggers = array_merge($triggers, $card->getTriggers());
        }

        $triggers = array_unique($triggers);

        return new CardData(
            name: 'Boon',
            set: $this->setProperName,
            card: true,
            triggers: $triggers,
        );
    }

    private function cursedgold(): CardData
    {
        return $this->card->getCardByName('Cursed Gold');
    }

    private function deluded(): CardData
    {
        return $this->card->getCardByName('Deluded/Envious');
    }

    private function ghost(): CardData
    {
        return $this->card->getCardByName('Ghost');
    }

    private function goat(): CardData
    {
        return $this->card->getCardByName('Goat');
    }

    private function hauntedmirror(): CardData
    {
        return $this->card->getCardByName('Haunted Mirror');
    }

    private function heirloom(string $heirloomName): CardData
    {
        $type = $heirloomName;

        if (str_contains($heirloomName, '_') === true) {
            $type = explode('_', $heirloomName, 2)[1];
        }

        return $this->$type();
    }

    private function hex(): CardData
    {
        $cards = $this->card->getCardsByType('hex');

        $triggers = [];
        foreach ($cards as $card) {
            $triggers = array_merge($triggers, $card->getTriggers());
        }

        $triggers = array_unique($triggers);

        return new CardData(
            name: 'Hex',
            set: $this->setProperName,
            card: true,
            triggers: $triggers,
        );
    }

    private function imp(): CardData
    {
        return $this->card->getCardByName('Imp');
    }

    private function lostinthewoods(): CardData
    {
        return $this->card->getCardByName('Lost In The Woods');
    }

    private function magiclamp(): CardData
    {
        return $this->card->getCardByName('Magic Lamp');
    }

    private function miserable(): CardData
    {
        return $this->card->getCardByName('Miserable/Twice Miserable');
    }

    private function pasture(): CardData
    {
        return $this->card->getCardByName('Pasture');
    }

    private function pouch(): CardData
    {
        return $this->card->getCardByName('Pouch');
    }

    private function state(string $stateName): CardData
    {
        $type = $stateName;

        if (str_contains($stateName, '_') === true) {
            $type = explode('_', $stateName, 2)[1];
        }

        return $this->$type();
    }

    private function vampire(): CardData
    {
        return $this->card->getCardByName('Vampire');
    }

    private function willowisp(): CardData
    {
        return $this->card->getCardByName('Will-o\'-Wisp');
    }

    private function wish(): CardData
    {
        return $this->card->getCardByName('Wish');
    }

    private function zombie(): CardData
    {
        $cards = $this->card->getCardsByType('zombie');

        $triggers = [];
        foreach ($cards as $card) {
            $triggers = array_merge($triggers, $card->getTriggers());
        }

        $triggers = array_unique($triggers);

        return new CardData(
            name: 'Zombie',
            set: $this->setProperName,
            card: true,
            triggers: $triggers,
        );
    }

    private function zombieapprentice(): CardData
    {
        return $this->card->getCardByName('Zombie Apprentice');
    }

    private function zombiemason(): CardData
    {
        return $this->card->getCardByName('Zombie Mason');
    }

    private function zombiespy(): CardData
    {
        return $this->card->getCardByName('Zombie Spy');
    }
}
