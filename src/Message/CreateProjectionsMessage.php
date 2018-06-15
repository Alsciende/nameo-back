<?php

declare(strict_types=1);

namespace App\Message;

use App\Entity\Match;

class CreateProjectionsMessage
{
    private $matchId;

    /**
     * CreateProjectionsMessage constructor.
     *
     * @param $matchId
     */
    public function __construct(Match $match)
    {
        $this->matchId = $match->getId();
    }

    /**
     * @return mixed
     */
    public function getMatchId()
    {
        return $this->matchId;
    }
}
