<?php

declare(strict_types=1);

namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class CreateResultModel
{
    /**
     * @Assert\NotBlank()
     */
    private $game;

    /**
     * @var CreateAttemptModel[]
     *
     * @Assert\Valid()
     */
    private $attempts = [];

    /**
     * @return mixed
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $game
     *
     * @return $this
     */
    public function setGame($game): self
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return CreateAttemptModel[]
     */
    public function getAttempts(): array
    {
        return $this->attempts;
    }

    /**
     * @param CreateAttemptModel[] $attempts
     *
     * @return $this
     */
    public function setAttempts(array $attempts): self
    {
        $this->attempts = $attempts;

        return $this;
    }
}
