<?php

namespace App\Tests\Form;

use App\Entity\Attempt;
use App\Entity\Card;
use App\Entity\Match;
use App\Form\AttemptType;
use App\Form\CardSelectorType;
use App\Form\DataTransformer\CardToIdTransformer;
use App\Form\DataTransformer\MatchToIdTransformer;
use App\Form\MatchSelectorType;
use App\Form\Model\CreateAttemptModel;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class AttemptTypeTest extends TypeTestCase
{
    /**
     * @var Match
     */
    private $match;

    /**
     * @var MatchToIdTransformer
     */
    private $matchTransformer;

    /**
     * @var Card
     */
    private $card;

    /**
     * @var CardToIdTransformer
     */
    private $cardTransformer;

    protected function setUp()
    {
        $this->match = $this->createMock(Match::class);
        $this->matchTransformer = $this->createMock(MatchToIdTransformer::class);
        $this->matchTransformer->method('transform')->willReturn('fu');
        $this->matchTransformer->method('reverseTransform')->with('fu')->willReturn($this->match);

        $this->card = $this->createMock(Card::class);
        $this->cardTransformer = $this->createMock(CardToIdTransformer::class);
        $this->cardTransformer->method('transform')->willReturn('bar');
        $this->cardTransformer->method('reverseTransform')->with('bar')->willReturn($this->card);

        parent::setUp();
    }

    protected function getExtensions()
    {
        return [
            new PreloadedExtension([new MatchSelectorType($this->matchTransformer)], []),
            new PreloadedExtension([new CardSelectorType($this->cardTransformer)], []),
        ];
    }

    public function testSubmitValidData()
    {
        $formData = [
            'match'         => 'fu',
            'step'          => 1,
            'card'          => 'bar',
            'presented_at'  => '2017-07-14T02:40:00+00:00',
            'presented_for' => 14,
            'outcome'       => 0,
        ];

        $objectToCompare = new CreateAttemptModel();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(AttemptType::class, $objectToCompare);

        $object = new CreateAttemptModel();
        $object->setCard($this->card);
        $object->setOutcome(Attempt::OUTCOME_ACCEPTED);
        $object->setPresentedAt('2017-07-14T02:40:00+00:00');
        $object->setPresentedFor(14);
        $object->setStep(1);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);
    }
}
