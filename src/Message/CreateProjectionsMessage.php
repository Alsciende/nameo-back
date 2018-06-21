<?php

declare(strict_types=1);

namespace App\Message;

use App\Entity\Game;

class CreateProjectionsMessage
{
    private $gameId;

    /**
     * CreateProjectionsMessage constructor.
     *
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->gameId = $game->getId();
    }

    /**
     * @return mixed
     */
    public function getGameId()
    {
        return $this->gameId;
    }
}
