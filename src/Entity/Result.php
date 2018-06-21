<?php

declare(strict_types=1);

namespace App\Entity;

class Result
{
    /**
     * @var Game
     */
    private $game;

    /**
     * @var Attempt[]
     */
    private $attempts;

    public function getGame(): Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getAttempts(): array
    {
        return $this->attempts;
    }

    public function setAttempts(array $attempts): self
    {
        $this->attempts = $attempts;

        return $this;
    }
}
