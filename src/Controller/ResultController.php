<?php

declare(strict_types=1);

namespace App\Controller;

use App\Behavior\JsonRequestContentTrait;
use App\Entity\Attempt;
use App\Entity\Match;
use App\Form\Model\CreateResultModel;
use App\Form\ResultType;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\ArrayTransformerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/matches/{id}/results")
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

    public function __construct(
        EntityManagerInterface $entityManager,
        ArrayTransformerInterface $normalizer
    ) {
        $this->entityManager = $entityManager;
        $this->normalizer = $normalizer;
    }

    /**
     * @param Request $request
     * @Route(path="/",methods={"POST"})
     */
    public function create(Request $request, Match $match)
    {
        $model = new CreateResultModel();
        $model->setMatch($match);
        $form = $this->createForm(ResultType::class, $model);

        $form->submit($this->getJsonRequestContent($request));

        if ($form->isSubmitted()/* && $form->isValid()*/) {
            foreach ($model->getAttempts() as $attemptModel) {
                $attempt = new Attempt(
                    $match,
                    $attemptModel->getStep(),
                    $attemptModel->getCard(),
                    $attemptModel->getPresentedAt(),
                    $attemptModel->getPresentedFor(),
                    $attemptModel->getOutcome()
                );

                $this->entityManager->persist($attempt);
            }

            $this->entityManager->flush();

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse($this->normalizer->toArray($form->getErrors(true)));
    }
}
