<?php

namespace Tests\Form;

use App\Entity\Match;
use App\Form\MatchType;
use Symfony\Component\Form\Test\TypeTestCase;

class MatchTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'nb_cards' => 30,
            'difficulty' => 2,
            'nb_players' => 6,
            'nb_teams' => 3,
            'start_at' => '2017-07-14T02:40:00+00:00'
        );

        $objectToCompare = new Match();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(MatchType::class, $objectToCompare);

        $object = new Match();
        $object->setDifficulty(2);
        $object->setNbCards(30);
        $object->setNbPlayers(6);
        $object->setNbTeams(3);
        $object->setStartAt(\DateTime::createFromFormat('U', '1500000000'));

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);
    }

    public function testSubmitValidDataNotUTC()
    {
        $formData = array(
            'nb_cards' => 30,
            'difficulty' => 2,
            'nb_players' => 6,
            'nb_teams' => 3,
            'start_at' => '2017-07-14T04:40:00+02:00'
        );

        $objectToCompare = new Match();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(MatchType::class, $objectToCompare);

        $object = new Match();
        $object->setDifficulty(2);
        $object->setNbCards(30);
        $object->setNbPlayers(6);
        $object->setNbTeams(3);
        $object->setStartAt(\DateTime::createFromFormat('U', '1500000000'));

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);
    }
}
