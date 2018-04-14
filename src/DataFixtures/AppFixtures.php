<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Card;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 200; $i++) {
            $card = new Card('Card ' . $i);
            $card->setDifficulty($i % Card::MAX_DIFFICULTY);

            $manager->persist($card);
        }

        $manager->flush();
    }
}
