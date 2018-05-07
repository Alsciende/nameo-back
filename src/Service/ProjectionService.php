<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Attempt;
use App\Entity\Card;
use App\Entity\CardProjection;
use App\Entity\Match;
use App\Entity\MatchCardProjection;
use App\Repository\AttemptRepository;
use App\Repository\CardProjectionRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProjectionService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var AttemptRepository
     */
    private $attemptRepository;

    /**
     * @var CardProjectionRepository
     */
    private $cardProjectionRepository;

    /**
     * ProjectionService constructor.
     *
     * @param EntityManagerInterface   $entityManager
     * @param AttemptRepository        $attemptRepository
     * @param CardProjectionRepository $cardProjectionRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        AttemptRepository $attemptRepository,
        CardProjectionRepository $cardProjectionRepository
    ) {
        $this->entityManager = $entityManager;
        $this->attemptRepository = $attemptRepository;
        $this->cardProjectionRepository = $cardProjectionRepository;
    }

    /**
     * @param Attempt[] $attempts
     *
     * @return MatchCardProjection[]
     */
    public function compileAttempts(array $attempts): array
    {
        /** @var MatchCardProjection[] $projections */
        $projections = [];

        foreach ($attempts as $attempt) {
            $cardId = $attempt->getCard()->getId();

            if (!isset($projections[$cardId])) {
                $projections[$cardId] = new MatchCardProjection($attempt->getMatch(), $attempt->getCard());
            }

            $projections[$cardId]->update($attempt);
        }

        return $projections;
    }

    /**
     * @param MatchCardProjection $matchCardProjection
     */
    public function applyProjection(MatchCardProjection $matchCardProjection)
    {
        $cardProjection = $this->cardProjectionRepository->findByProjection($matchCardProjection);

        if (!$cardProjection instanceof CardProjection) {
            $cardProjection = new CardProjection($matchCardProjection->getCard());
            $this->entityManager->persist($cardProjection);
        }

        $cardProjection->update($matchCardProjection);
    }

    /**
     * @param Match $match
     */
    public function createProjections(Match $match)
    {
        foreach ($this->compileAttempts($this->attemptRepository->findByMatch($match)) as $matchCardProjection) {
            $this->entityManager->persist($matchCardProjection);
            $this->applyProjection($matchCardProjection);
        }
    }

    public function updateCardsDifficulty()
    {
        $this->applyOrderToDifficulty($this->cardProjectionRepository->findAllCardsSortedByProjection());
    }

    /**
     * @param Card[] $cards
     */
    public function applyOrderToDifficulty(array $cards)
    {
        $quantile = count($cards) / 5;

        foreach ($cards as $i => $card) {
            $card->setDifficulty(intval(floor($i / $quantile)));
        }
    }
}
