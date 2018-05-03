<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardProjectionRepository")
 * @ORM\Table(name="card_projections")
 */
class CardProjection
{
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

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $nbMatches;

    public function __construct(Card $card)
    {
        $this->card = $card;
        $this->presentedForSum = 0;
        $this->nbMatches = 0;
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
     * @return int
     */
    public function getNbMatches(): int
    {
        return $this->nbMatches;
    }

    /**
     * @param MatchCardProjection $projection
     *
     * @return $this
     */
    public function update(MatchCardProjection $projection): self
    {
        if (false === $this->card->isEqualTo($projection->getCard())) {
            throw new \LogicException('Trying to combine data from different cards.');
        }

        $this->nbMatches++;
        $this->presentedForSum += $projection->getPresentedForSum();

        return $this;
    }
}
