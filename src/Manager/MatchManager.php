<?php

declare(strict_types=1);

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
     */
    public function drawCards(Match $match)
    {
        $byDifficulty = $this->repository->sortedByDifficulty();

        $difficulties = $this->distribution->boundedAndCentered(
            0,
            Card::MAX_DIFFICULTY,
            $match->getDifficulty(),
            $match->getNbCards()
        );

        foreach ($difficulties as $difficulty) {
            $count = count($byDifficulty[$difficulty]);
            if (0 === $count) {
                throw new NotEnoughCardsException('Not enough cards in difficulty ' . $difficulty);
            }
            $removedCards = array_splice($byDifficulty[$difficulty], mt_rand(0, $count - 1), 1);
            $match->addCard($removedCards[0]);
        }
    }
}
