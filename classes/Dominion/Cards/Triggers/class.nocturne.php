<?php

declare(strict_types=1);

namespace Dominion\Cards\Triggers;

use Dominion\Cards\Card;
use Dominion\Cards\Validation\CardData;
use Dominion\Kingdom\Kingdom;
use Medoo\Medoo;

class Nocturne
{
    use General;

    public function __construct(private readonly Medoo $db, private readonly Card $card, private readonly Kingdom $kingdom)
    {
        $this->set = 'menagerie';
        $this->setProperName = 'Menagerie';
    }

    private function bat(): CardData
    {
        return $this->card->getCardByName('Bat');
    }

    /**
     * @return array<\Dominion\Cards\Validation\CardData>
     */
    private function boon(): array
    {
        return $this->card->getCardsByType('Loot');
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

    private function heirloom(string $heirloomName): void
    {
        $type = $heirloomName;

        if (str_contains($heirloomName, '_') === true) {
            $type = explode('_', $heirloomName, 2)[1];
        }

        $this->$type();
    }

    /**
     * @return array<\Dominion\Cards\Validation\CardData>
     */
    private function hex(): array
    {
        return $this->card->getCardsByType('Hex');
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

    private function state(string $stateName): void
    {
        $type = $stateName;

        if (str_contains($stateName, '_') === true) {
            $type = explode('_', $stateName, 2)[1];
        }

        $this->$type();
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
