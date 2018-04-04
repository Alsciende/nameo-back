<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Match
{

    /**
     * @var int
     */
    protected $nbCards = 40;

    /**
     * @var int
     */
    protected $difficulty = 0;

    /**
     * @var int
     */
    protected $nbPlayers = 4;

    /**
     * @var int
     */
    protected $nbTeams = 2;

    /**
     * @var \DateTime
     */
    protected $startAt;

    /**
     * @var Collection|Card[]
     */
    protected $cards;

    public function __construct() {
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

    public function getCards()
    {
        return $this->cards;
    }

    public function setCards($cards): self
    {
        $this->cards = $cards;

        return $this;
    }


}
