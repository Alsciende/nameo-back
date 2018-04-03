<?php

namespace App\Repository;

use App\Entity\Card;
use Doctrine\ORM\EntityRepository;

class CardRepository extends EntityRepository
{
    /**
     * @return Card[][]
     */
    public function getCardsByDecile(): array
    {
        $result = array_fill(0, 12, []);

        /** @var Card[] $cards */
        $cards = $this->findAll();

        foreach ($cards as $card) {
            $result[$card->getDecile()][] = $card;
        }

        return $result;
    }
}
