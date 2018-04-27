<?php

declare(strict_types=1);

namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class CreateAttemptModel
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     */
    private $match;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    private $step;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     */
    private $card;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $presentedAt;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    private $presentedFor;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    private $outcome;

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
     * @return mixed
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param mixed $step
     *
     * @return self
     */
    public function setStep($step): self
    {
        $this->step = $step;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param mixed $card
     *
     * @return self
     */
    public function setCard($card): self
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPresentedAt()
    {
        return $this->presentedAt;
    }

    /**
     * @param mixed $presentedAt
     *
     * @return self
     */
    public function setPresentedAt($presentedAt): self
    {
        $this->presentedAt = $presentedAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPresentedFor()
    {
        return $this->presentedFor;
    }

    /**
     * @param mixed $presentedFor
     *
     * @return self
     */
    public function setPresentedFor($presentedFor): self
    {
        $this->presentedFor = $presentedFor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * @param mixed $outcome
     *
     * @return self
     */
    public function setOutcome($outcome): self
    {
        $this->outcome = $outcome;

        return $this;
    }
}
