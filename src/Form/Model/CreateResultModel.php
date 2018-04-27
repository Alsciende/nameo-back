<?php

declare(strict_types=1);

namespace App\Form\Model;

class CreateResultModel
{
    private $match;

    /**
     * @var CreateAttemptModel[]
     */
    private $attempts = [];

    /**
     * @return mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param mixed $match
     *
     * @return self
     */
    public function setMatch($match): self
    {
        $this->match = $match;

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
     * @return self
     */
    public function setAttempts(array $attempts): self
    {
        $this->attempts = $attempts;

        return $this;
    }
}
