<?php

namespace App\Manager;

use App\Distribution\DistributionInterface;
use App\Entity\Card;
use App\Entity\Match;
use App\Exception\NotEnoughCardsException;
use App\Repository\CardRepository;

class MatchManager
{
    /**
     * @var DistributionInterface
     */
    private $distribution;

    /**
     * @var CardRepository
     */
    private $repository;

    public function __construct(DistributionInterface $distribution, CardRepository $repository)
    {
        $this->distribution = $distribution;
        $this->repository = $repository;
    }

    /**
     * @param Match $match
     * @return Card[]
     */
    public function draw(Match $match): array
    {
        $cardsByDecile = $this->repository->getCardsByDecile();

        $list = [];
        $deciles = $this->distribution->boundedAndCentered(0, 9, $match->getDifficulty(), $match->getQuantity());

        foreach ($deciles as $decile) {
            $cards = $cardsByDecile[$decile];
            if (count($cards) === 0) {
                throw new NotEnoughCardsException('Not enough cards in decile ' . $decile);
            }
            $randomIndex = mt_rand(0, count($cards) - 1);
            $removedCards = array_splice($cards, $randomIndex, 1);
            $list[] = $removedCards[0];
        }

        return $list;
    }
}
