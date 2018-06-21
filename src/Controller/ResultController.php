<?php

declare(strict_types=1);

namespace App\Controller;

use App\Behavior\JsonRequestContentTrait;
use App\Entity\Attempt;
use App\Entity\Game;
use App\Form\Model\CreateResultModel;
use App\Form\ResultType;
use App\Message\CreateProjectionsMessage;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\ArrayTransformerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/games/{id}/results")
 */
class ResultController extends Controller
{
    use JsonRequestContentTrait;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ArrayTransformerInterface
     */
    private $normalizer;

    /**
     * @var MessageBusInterface
     */
    private $bus;

    public function __construct(
        EntityManagerInterface $entityManager,
        ArrayTransformerInterface $normalizer,
        MessageBusInterface $bus
    ) {
        $this->entityManager = $entityManager;
        $this->normalizer = $normalizer;
        $this->bus = $bus;
    }

    /**
     * @param Request $request
     * @Route(path="/",methods={"POST"})
     */
    public function create(Request $request, Game $game)
    {
        $model = new CreateResultModel();
        $model->setGame($game);
        $form = $this->createForm(ResultType::class, $model);

        $form->submit($this->getJsonRequestContent($request));

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($model->getAttempts() as $attemptModel) {
                $attempt = new Attempt(
                    $game,
                    $attemptModel->getStep(),
                    $attemptModel->getCard(),
                    $attemptModel->getPresentedAt(),
                    $attemptModel->getPresentedFor(),
                    $attemptModel->getOutcome()
                );

                $this->entityManager->persist($attempt);
            }

            $this->entityManager->flush();
            $this->bus->dispatch(new CreateProjectionsMessage($game));

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse($this->normalizer->toArray($form->getErrors(true)));
    }
}
