<?php

namespace App\Entity;

class Card
{
    protected $title;

    protected $link;

    protected $decile;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     *
     * @return self
     */
    public function setLink($link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDecile()
    {
        return $this->decile;
    }

    /**
     * @param mixed $decile
     *
     * @return self
     */
    public function setDecile($decile): self
    {
        $this->decile = $decile;

        return $this;
    }


}
