<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Card;
use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadCards($manager);
        $this->loadGame($manager);

        $manager->flush();
    }

    public function loadCards(ObjectManager $manager)
    {
        for ($i = 0; $i < 200; $i++) {
            $card = new Card('Card ' . $i);
            $card->setDifficulty($i % Card::MAX_DIFFICULTY);

            $manager->persist($card);
        }
    }

    public function loadGame(ObjectManager $manager)
    {
        $game = new Game(40, 3, 4, 2, '2017-07-14T08:40:00+06:00');

        $manager->persist($game);
    }
}
