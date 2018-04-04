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
        $byDifficulty = $this->repository->sortedByDifficulty();

        $list = [];
        $difficulties = $this->distribution->boundedAndCentered(
            0,
            Card::MAX_DIFFICULTY,
            $match->getDifficulty(),
            $match->getNbCards()
        );

        foreach ($difficulties as $difficulty) {
            $cards = $byDifficulty[$difficulty];
            if (count($cards) === 0) {
                throw new NotEnoughCardsException('Not enough cards in difficulty ' . $difficulty);
            }
            $randomIndex = mt_rand(0, count($cards) - 1);
            $removedCards = array_splice($cards, $randomIndex, 1);
            $list[] = $removedCards[0];
        }

        return $list;
    }
}
