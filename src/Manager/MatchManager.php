<?php

namespace App\Manager;

use App\Entity\Card;
use App\Entity\Match;
use App\Exception\NotEnoughCardsException;
use App\Repository\CardRepository;
use App\Service\BoundedDistributionProvider;

class MatchManager
{
    /**
     * @var BoundedDistributionProvider
     */
    private $provider;

    /**
     * @var CardRepository
     */
    private $repository;

    public function __construct(BoundedDistributionProvider $provider, CardRepository $repository)
    {
        $this->provider = $provider;
        $this->repository = $repository;
    }

    /**
     * @param Match $match
     * @return Card[]
     */
    public function draw(Match $match): array
    {
        $cardsByDecile = $this->repository->getCardsByDecile();

        $list = [];

        for ($i = 0; $i < $match->getQuantity(); $i++) {
            $decile = $this->provider->rand(0, 9, $match->getDifficulty());
            $cards = $cardsByDecile[$decile];
            if (count($cards) === 0) {
                throw new NotEnoughCardsException('Not enough cards in decile ' . $decile);
            }
            $randomIndex = mt_rand(0, count($cards) - 1);
            $removedCards = array_splice($cards, $randomIndex, 1);
            $list[] = $removedCards[0];
        }

        return $list;
    }
}
