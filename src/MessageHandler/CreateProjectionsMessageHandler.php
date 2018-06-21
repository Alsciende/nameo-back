<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Entity\Game;
use App\Message\CreateProjectionsMessage;
use App\Repository\GameRepository;
use App\Service\ProjectionService;

class CreateProjectionsMessageHandler
{
    /**
     * @var GameRepository
     */
    private $repository;

    /**
     * @var ProjectionService
     */
    private $projectionService;

    /**
     * CreateProjectionsMessageHandler constructor.
     */
    public function __construct(GameRepository $repository, ProjectionService $projectionService)
    {
        $this->repository = $repository;
        $this->projectionService = $projectionService;
    }

    public function __invoke(CreateProjectionsMessage $message)
    {
        $game = $this->repository->find($message->getGameId());
        if ($game instanceof Game) {
            $this->projectionService->createProjections($game);
        }
    }
}
