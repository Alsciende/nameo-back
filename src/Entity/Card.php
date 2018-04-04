<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Card
 *
 * @ORM\Entity()
 * @ORM\Table(name="cards",uniqueConstraints={@ORM\UniqueConstraint(name="title_idx", columns={"title"})})
 */
class Card
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(name="id",nullable=false,type="string")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title",nullable=false,type="string")
     */
    protected $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="link",nullable=true,type="string")
     */
    protected $link;

    /**
     * @var int
     *
     * @ORM\Column(name="decile",nullable=false,type="integer")
     */
    protected $decile;

    /**
     * Card constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
        $this->decile = 0;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param null|string $link
     *
     * @return self
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return int
     */
    public function getDecile(): int
    {
        return $this->decile;
    }

    /**
     * @param int $decile
     *
     * @return self
     */
    public function setDecile(int $decile): self
    {
        $this->decile = $decile;

        return $this;
    }


}
