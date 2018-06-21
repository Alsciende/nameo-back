<?php

namespace App\Tests\Entity;

use App\Entity\Card;
use App\Entity\CardProjection;
use App\Entity\Game;
use App\Entity\GameCardProjection;
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
        $gameCardProjection = $this->createMock(GameCardProjection::class);
        $gameCardProjection->method('getCard')->willReturn($card);
        $gameCardProjection->method('getPresentedForSum')->willReturn(11);

        $object = new CardProjection($card);
        $object->update($gameCardProjection);
        $this->assertEquals(11, $object->getPresentedForSum());
        $this->assertEquals(1, $object->getNbGames());
        $object->update($gameCardProjection);
        $this->assertEquals(22, $object->getPresentedForSum());
        $this->assertEquals(2, $object->getNbGames());
    }
}
