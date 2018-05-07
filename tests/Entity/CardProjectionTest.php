<?php

namespace App\Tests\Entity;

use App\Entity\Card;
use App\Entity\CardProjection;
use App\Entity\Match;
use App\Entity\MatchCardProjection;
use PHPUnit\Framework\TestCase;

class CardProjectionTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testUpdate()
    {
        $card = $this->createMock(Card::class);
        $card->method('getId')->willReturn('fu');
        $matchCardProjection = $this->createMock(MatchCardProjection::class);
        $matchCardProjection->method('getCard')->willReturn($card);
        $matchCardProjection->method('getPresentedForSum')->willReturn(11);

        $object = new CardProjection($card);
        $object->update($matchCardProjection);
        $this->assertEquals(11, $object->getPresentedForSum());
        $this->assertEquals(1, $object->getNbMatches());
        $object->update($matchCardProjection);
        $this->assertEquals(22, $object->getPresentedForSum());
        $this->assertEquals(2, $object->getNbMatches());
    }
}
