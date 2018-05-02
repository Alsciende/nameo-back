<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Attempt;
use App\Entity\Match;
use App\Entity\MatchCardProjection;
use App\Repository\AttemptRepository;
use App\Repository\CardRepository;
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
     * @var CardRepository
     */
    private $cardRepository;

    /**
     * ProjectionService constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param AttemptRepository      $attemptRepository
     * @param CardRepository         $cardRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        AttemptRepository $attemptRepository,
        CardRepository $cardRepository
    ) {
        $this->entityManager = $entityManager;
        $this->attemptRepository = $attemptRepository;
        $this->cardRepository = $cardRepository;
    }

    /**
     * @param Attempt[] $attempts
     *
     * @return MatchCardProjection[]
     */
    public function compileAttempts(array $attempts)
    {
        /** @var MatchCardProjection[] $projections */
        $projections = [];

        foreach ($attempts as $attempt) {
            if (!isset($projections[$attempt->getCard()->getId()])) {
                $projections[$attempt->getCard()->getId()] = new MatchCardProjection($attempt->getMatch(), $attempt->getCard());
            }

            $projections[$attempt->getCard()->getId()]->addToPresentedForSum($attempt->getPresentedFor());
        }

        return $projections;
    }

    /**
     * @param Match $match
     */
    public function createMatchCardProjections(Match $match)
    {
        $projections = $this->compileAttempts($this->attemptRepository->findBy(['match' => $match]));

        foreach ($projections as $projection) {
            $this->entityManager->persist($projection);
        }
    }
}
