<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Card;

class CardSortingService
{
    /**
     * @param Card[] $cards
     *
     * @return Card[][]
     */
    public function sortCardsByDifficulty(array $cards)
    {
        $result = array_fill(0, Card::MAX_DIFFICULTY, []);

        foreach ($cards as $card) {
            $result[$card->getDifficulty()][] = $card;
        }

        return $result;
    }
}
