<?php

namespace App\Repository;

use App\Entity\Card;
use Doctrine\ORM\EntityRepository;

class CardRepository extends EntityRepository
{
    /**
     * @return Card[][]
     */
    public function sortedByDifficulty(): array
    {
        $result = array_fill(0, Card::MAX_DIFFICULTY, []);

        /** @var Card[] $cards */
        $cards = $this->findAll();

        foreach ($cards as $card) {
            $result[$card->getDifficulty()][] = $card;
        }

        return $result;
    }
}
