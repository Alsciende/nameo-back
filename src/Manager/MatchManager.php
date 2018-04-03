<?php

namespace App\Manager;

use App\Entity\Card;
use App\Entity\Match;
use App\Repository\CardRepository;
use App\Service\BoundedDistributionProvider;

class MatchManager
{
    /**
     * @param Match                       $match
     * @param BoundedDistributionProvider $provider
     * @param CardRepository              $repository
     * @return Card[]
     */
    public function draw(Match $match, BoundedDistributionProvider $provider, CardRepository $repository): array
    {
        $cardsByDecile = $repository->getCardsByDecile();

        $list = [];

        for ($i = 0; $i < $match->getQuantity(); $i++) {
            // get a random quantile centered around $quantile
            $randomQuantile = $provider->rand(0, 11, $match->getDifficulty());
            // get a random card belonging to that quantile
            $randomIndex = mt_rand(0, count($cardsByDecile[$randomQuantile]) - 1);
            // remove the card from the collection to avoid duplicates
            $removedCards = array_splice($cardsByDecile[$randomQuantile], $randomIndex, 1);
            // add the picked card to the result
            $list[] = $removedCards[0];
        }

        return $list;
    }
}
