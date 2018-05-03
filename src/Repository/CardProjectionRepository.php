<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Card;
use App\Entity\CardProjection;
use App\Entity\MatchCardProjection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CardProjectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardProjection::class);
    }

    /**
     * @param MatchCardProjection $matchCardProjection
     *
     * @return CardProjection|null
     */
    public function findByProjection(MatchCardProjection $matchCardProjection)
    {
        return $this->findOneBy(['card' => $matchCardProjection->getCard()]);
    }

    /**
     * @return Card[]
     */
    public function findAllCardsSortedByProjection()
    {
        $dql = 'SELECT p, c, p.presentedForSum / p.nbMatches AS HIDDEN presentedForAvg FROM App:CardProjection p JOIN p.card c ORDER BY presentedForAvg ASC';
        $query = $this->getEntityManager()->createQuery($dql);
        $projections = $query->getResult();

        return array_map(function (CardProjection $projection) {
            return $projection->getCard();
        }, $projections);
    }
}
