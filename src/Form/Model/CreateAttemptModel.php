<?php

declare(strict_types=1);

namespace App\Form\Model;

use App\Entity\Card;
use App\Entity\Match;

class CreateAttemptModel
{
    /**
     * @var Match|null
     */
    private $match;

    /**
     * @var int|null
     */
    private $step;

    /**
     * @var Card|null
     */
    private $card;

    /**
     * @var \DateTime|null
     */
    private $presentedAt;

    /**
     * @var int|null
     */
    private $presentedFor;

    /**
     * @var int|null
     */
    private $outcome;

    /**
     * @return Match|null
     */
    public function getMatch(): ?Match
    {
        return $this->match;
    }

    /**
     * @param Match|null $match
     *
     * @return self
     */
    public function setMatch(?Match $match): self
    {
        $this->match = $match;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStep(): ?int
    {
        return $this->step;
    }

    /**
     * @param int|null $step
     *
     * @return self
     */
    public function setStep(?int $step): self
    {
        $this->step = $step;

        return $this;
    }

    /**
     * @return Card|null
     */
    public function getCard(): ?Card
    {
        return $this->card;
    }

    /**
     * @param Card|null $card
     *
     * @return self
     */
    public function setCard(?Card $card): self
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getPresentedAt(): ?\DateTime
    {
        return $this->presentedAt;
    }

    /**
     * @param \DateTime|null $presentedAt
     *
     * @return self
     */
    public function setPresentedAt(?\DateTime $presentedAt): self
    {
        $this->presentedAt = $presentedAt;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPresentedFor(): ?int
    {
        return $this->presentedFor;
    }

    /**
     * @param int|null $presentedFor
     *
     * @return self
     */
    public function setPresentedFor(?int $presentedFor): self
    {
        $this->presentedFor = $presentedFor;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOutcome(): ?int
    {
        return $this->outcome;
    }

    /**
     * @param int|null $outcome
     *
     * @return self
     */
    public function setOutcome(?int $outcome): self
    {
        $this->outcome = $outcome;

        return $this;
    }
}
