<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(
 *     name="links",
 *     )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Link
{
    const SITE_WIKIPEDIA = 'fr.wikipedia.org';

    /**
     * @var Card
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id", nullable=false)
     * @ORM\Id()
     */
    private $card;

    /**
     * @var string
     *
     * @ORM\Column(type="string",nullable=false)
     * @ORM\Id()
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(type="string",nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(type="string",nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string",nullable=true)
     */
    private $externalId;

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
     * @return self
     */
    public function setCard(Card $card): self
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @return string
     */
    public function getSite(): string
    {
        return $this->site;
    }

    /**
     * @param string $site
     *
     * @return self
     */
    public function setSite(string $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
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
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     *
     * @return self
     */
    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }
}
