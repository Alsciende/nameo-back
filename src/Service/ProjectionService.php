<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Attempt;
use App\Entity\Card;
use App\Entity\CardProjection;
use App\Entity\Game;
use App\Entity\GameCardProjection;
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
     * @return GameCardProjection[]
     */
    public function compileAttempts(array $attempts): array
    {
        /** @var GameCardProjection[] $projections */
        $projections = [];

        foreach ($attempts as $attempt) {
            $cardId = $attempt->getCard()->getId();

            if (!isset($projections[$cardId])) {
                $projections[$cardId] = new GameCardProjection($attempt->getGame(), $attempt->getCard());
            }

            $projections[$cardId]->update($attempt);
        }

        return $projections;
    }

    /**
     * @param GameCardProjection $gameCardProjection
     */
    public function applyProjection(GameCardProjection $gameCardProjection)
    {
        $cardProjection = $this->cardProjectionRepository->findByProjection($gameCardProjection);

        if (!$cardProjection instanceof CardProjection) {
            $cardProjection = new CardProjection($gameCardProjection->getCard());
            $this->entityManager->persist($cardProjection);
        }

        $cardProjection->update($gameCardProjection);
    }

    /**
     * @param Game $game
     */
    public function createProjections(Game $game)
    {
        foreach ($this->compileAttempts($this->attemptRepository->findByGame($game)) as $gameCardProjection) {
            $this->entityManager->persist($gameCardProjection);
            $this->applyProjection($gameCardProjection);
        }

        $this->entityManager->flush();
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
