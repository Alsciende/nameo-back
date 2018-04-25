<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Card;
use App\Entity\Match;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadCards($manager);
        $this->loadMatch($manager);

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

    public function loadMatch(ObjectManager $manager)
    {
        $match = new Match();
        $match->setDifficulty(3);
        $match->setNbCards(40);
        $match->setNbPlayers(4);
        $match->setNbTeams(2);
        $match->setStartAt(\DateTime::createFromFormat('Y-m-d H:i:s', '2018-01-01 12:00:00'));

        $manager->persist($match);
    }
}
