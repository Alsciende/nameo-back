<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Card::class);
    }

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
