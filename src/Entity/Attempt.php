<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(name="attempts",indexes={@ORM\Index(columns={"step","presented_at"})})
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Attempt
{
    const OUTCOME_ACCEPTED = 0;
    const OUTCOME_REJECTED = 1;
    const OUTCOME_TIMEOUT = 2;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Match
     *
     * @ORM\ManyToOne(targetEntity="Match")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id", nullable=false)
     */
    private $match;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $step;

    /**
     * @var Card
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id", nullable=false)
     */
    private $card;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $presentedAt;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $presentedFor;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $outcome;

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }

    /**
     * @param Match $match
     *
     * @return $this
     */
    public function setMatch(Match $match): self
    {
        $this->match = $match;

        return $this;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     * @param Card $card
     *
     * @return $this
     */
    public function setCard(Card $card): self
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @return int
     */
    public function getStep(): int
    {
        return $this->step;
    }

    /**
     * @param int $step
     *
     * @return $this
     */
    public function setStep(int $step): self
    {
        $this->step = $step;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPresentedAt(): \DateTime
    {
        return $this->presentedAt;
    }

    /**
     * @param \DateTime $presentedAt
     *
     * @return $this
     */
    public function setPresentedAt(\DateTime $presentedAt): self
    {
        $this->presentedAt = $presentedAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getPresentedFor(): int
    {
        return $this->presentedFor;
    }

    /**
     * @param int $presentedFor
     *
     * @return $this
     */
    public function setPresentedFor(int $presentedFor): self
    {
        $this->presentedFor = $presentedFor;

        return $this;
    }

    /**
     * @return int
     */
    public function getOutcome(): int
    {
        return $this->outcome;
    }

    /**
     * @param int $outcome
     *
     * @return $this
     */
    public function setOutcome(int $outcome): self
    {
        $this->outcome = $outcome;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
