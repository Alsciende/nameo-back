<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Card;
use App\Entity\Match;
use App\Repository\CardRepository;
use App\Util\ArrayPicker;

class CardDrawingService
{
    /**
     * @var CardRepository
     */
    private $cardRepository;

    public function __construct(CardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    /**
     * @param Match $match
     */
    public function drawCards(Match $match)
    {
        $this->drawCardsFromPool($match, $match->getNbCards(), $this->cardRepository->findAllWithoutDifficulty());
        $this->drawCardsFromPool($match, $match->getNbCards(), $this->cardRepository->findAllWithDifficulty($match->getDifficulty()));
    }

    /**
     * @param Match  $match
     * @param int    $max
     * @param Card[] $pool
     */
    public function drawCardsFromPool(Match $match, int $max, array $pool)
    {
        if ($max > count($match->getCards())) {
            while ($max > count($match->getCards()) && count($pool) > 0) {
                $match->addCard(ArrayPicker::pickOne($pool));
            }
        }
    }
}
