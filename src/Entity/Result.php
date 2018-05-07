<?php

declare(strict_types=1);

namespace App\Entity;

class Result
{
    /**
     * @var Match
     */
    private $match;

    /**
     * @var Attempt[]
     */
    private $attempts;

    public function getMatch(): Match
    {
        return $this->match;
    }

    public function setMatch(Match $match): self
    {
        $this->match = $match;

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
