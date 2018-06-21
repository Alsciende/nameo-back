<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Card;
use App\Entity\Game;
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
     * @param Game $game
     */
    public function drawCards(Game $game)
    {
        $this->drawCardsFromPool($game, $game->getNbCards(), $this->cardRepository->findAllWithoutDifficulty());
        $this->drawCardsFromPool($game, $game->getNbCards(), $this->cardRepository->findAllWithDifficulty($game->getDifficulty()));
    }

    /**
     * @param Game   $game
     * @param int    $max
     * @param Card[] $pool
     */
    public function drawCardsFromPool(Game $game, int $max, array $pool)
    {
        if ($max > count($game->getCards())) {
            while ($max > count($game->getCards()) && count($pool) > 0) {
                $game->addCard(ArrayPicker::pickOne($pool));
            }
        }
    }
}
