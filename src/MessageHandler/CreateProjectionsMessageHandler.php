<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Entity\Match;
use App\Message\CreateProjectionsMessage;
use App\Repository\MatchRepository;
use App\Service\ProjectionService;

class CreateProjectionsMessageHandler
{
    /**
     * @var MatchRepository
     */
    private $repository;

    /**
     * @var ProjectionService
     */
    private $projectionService;

    /**
     * CreateProjectionsMessageHandler constructor.
     */
    public function __construct(MatchRepository $repository, ProjectionService $projectionService)
    {
        $this->repository = $repository;
        $this->projectionService = $projectionService;
    }

    public function __invoke(CreateProjectionsMessage $message)
    {
        $match = $this->repository->find($message->getMatchId());
        if ($match instanceof Match) {
            $this->projectionService->createProjections($match);
        }
    }
}
