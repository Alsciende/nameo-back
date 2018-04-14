<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Match.
 *
 * @ORM\Entity()
 * @ORM\Table(name="matches")
 */
class Match
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(type="string",length=36)
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer",nullable=false)
     *
     * @Assert\NotBlank()
     */
    protected $nbCards = 40;

    /**
     * @var int
     *
     * @ORM\Column(type="integer",nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="0",max="5")
     */
    protected $difficulty = 0;

    /**
     * @var int
     *
     * @ORM\Column(type="integer",nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="4")
     */
    protected $nbPlayers = 4;

    /**
     * @var int
     *
     * @ORM\Column(type="integer",nullable=false)
     *
     * @Assert\Range(min="2")
     */
    protected $nbTeams = 2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=false)
     *
     * @Assert\NotBlank()
     */
    protected $startAt;

    /**
     * @var ArrayCollection
     */
    protected $cards;

    public function __construct()
    {
        $this->startAt = new \DateTime();
        $this->cards = new ArrayCollection();
    }

    public function getNbCards(): int
    {
        return $this->nbCards;
    }

    public function setNbCards(int $nbCards): self
    {
        $this->nbCards = $nbCards;

        return $this;
    }

    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getNbPlayers(): int
    {
        return $this->nbPlayers;
    }

    public function setNbPlayers(int $nbPlayers): self
    {
        $this->nbPlayers = $nbPlayers;

        return $this;
    }

    public function getNbTeams(): int
    {
        return $this->nbTeams;
    }

    public function setNbTeams(int $nbTeams): self
    {
        $this->nbTeams = $nbTeams;

        return $this;
    }

    public function getStartAt(): \DateTime
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTime $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * @return array
     */
    public function getCards(): array
    {
        return $this->cards->toArray();
    }

    /**
     * @param array $cards
     *
     * @return Match
     */
    public function setCards(iterable $cards): self
    {
        $this->clearCards();
        foreach ($cards as $card) {
            $this->addCard($card);
        }

        return $this;
    }

    /**
     * @return Match
     */
    public function clearCards(): self
    {
        $this->cards->clear();

        return $this;
    }

    /**
     * @param Card $card
     *
     * @return Match
     */
    public function addCard(Card $card): self
    {
        if (false === $this->cards->contains($card)) {
            $this->cards->add($card);
        }

        return $this;
    }

    /**
     * @param Card $card
     *
     * @return Match
     */
    public function removeCard(Card $card): self
    {
        if ($this->cards->contains($card)) {
            $this->cards->removeElement($card);
        }

        return $this;
    }
}
