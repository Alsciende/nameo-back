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
     * Index: idx_card_difficulty
     *
     * @return array
     */
    public function findAllWithoutDifficulty()
    {
        return $this->findBy(['difficulty' => null]);
    }

    /**
     * Index: idx_card_difficulty
     *
     * @return array
     */
    public function findAllWithDifficulty(int $difficulty)
    {
        return $this->findBy(['difficulty' => $difficulty]);
    }
}
