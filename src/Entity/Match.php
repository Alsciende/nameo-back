<?php

namespace App\Entity;

class Match
{
    protected $quantity;

    protected $difficulty;

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     *
     * @return self
     */
    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

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
     * @return self
     */
    public function setDifficulty($difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }


}
