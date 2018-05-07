<?php

declare(strict_types=1);

namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class CreateMatchModel
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    private $nbCards = 40;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     * @Assert\Range(min="0",max="5")
     */
    private $difficulty = 0;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     * @Assert\Range(min="4")
     */
    private $nbPlayers = 4;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     * @Assert\Range(min="2")
     */
    private $nbTeams = 2;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $startedAt;

    /**
     * @return mixed
     */
    public function getNbCards()
    {
        return $this->nbCards;
    }

    /**
     * @param mixed $nbCards
     *
     * @return $this
     */
    public function setNbCards($nbCards): self
    {
        $this->nbCards = $nbCards;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param mixed $difficulty
     *
     * @return $this
     */
    public function setDifficulty($difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNbPlayers()
    {
        return $this->nbPlayers;
    }

    /**
     * @param mixed $nbPlayers
     *
     * @return $this
     */
    public function setNbPlayers($nbPlayers): self
    {
        $this->nbPlayers = $nbPlayers;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNbTeams()
    {
        return $this->nbTeams;
    }

    /**
     * @param mixed $nbTeams
     *
     * @return $this
     */
    public function setNbTeams($nbTeams): self
    {
        $this->nbTeams = $nbTeams;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * @param mixed $startedAt
     *
     * @return $this
     */
    public function setStartedAt($startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }
}
