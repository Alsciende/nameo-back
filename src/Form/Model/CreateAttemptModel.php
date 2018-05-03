<?php

declare(strict_types=1);

namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class CreateAttemptModel
{
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
     * @Assert\Length(min="25",max="25")
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
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param mixed $step
     *
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setOutcome($outcome): self
    {
        $this->outcome = $outcome;

        return $this;
    }
}
