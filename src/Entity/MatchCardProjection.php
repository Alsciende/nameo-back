<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="match_card_projections")
 */
class MatchCardProjection
{
    /**
     * @var Match
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Match")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id", nullable=false)
     */
    private $match;

    /**
     * @var Card
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id", nullable=false)
     */
    private $card;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $presentedForSum;

    public function __construct(Match $match, Card $card)
    {
        $this->match = $match;
        $this->card = $card;
        $this->presentedForSum = 0;
    }

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     * @return int
     */
    public function getPresentedForSum(): int
    {
        return $this->presentedForSum;
    }

    /**
     * @param int $presentedForSum
     *
     * @return self
     */
    public function setPresentedForSum(int $presentedForSum): self
    {
        $this->presentedForSum = $presentedForSum;

        return $this;
    }

    /**
     * @param int $presentedFor
     *
     * @return self
     */
    public function addToPresentedForSum(int $presentedFor): self
    {
        $this->presentedForSum += $presentedFor;

        return $this;
    }
}
