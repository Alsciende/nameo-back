<?php

declare(strict_types=1);

namespace App\Controller;

use App\Behavior\JsonRequestContentTrait;
use App\Entity\Match;
use App\Form\MatchType;
use App\Form\Model\CreateMatchModel;
use App\Service\CardDrawingService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\ArrayTransformerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/matches")
 */
class MatchController extends Controller
{
    use JsonRequestContentTrait;

    /**
     * @var CardDrawingService
     */
    private $drawing;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ArrayTransformerInterface
     */
    private $normalizer;

    public function __construct(
        CardDrawingService $drawing,
        EntityManagerInterface $entityManager,
        ArrayTransformerInterface $normalizer
    ) {
        $this->drawing = $drawing;
        $this->entityManager = $entityManager;
        $this->normalizer = $normalizer;
    }

    /**
     * @param Request $request
     * @Route(path="/",methods={"POST"})
     */
    public function create(Request $request)
    {
        $model = new CreateMatchModel();
        $form = $this->createForm(MatchType::class, $model);

        $form->submit($this->getJsonRequestContent($request));

        if ($form->isSubmitted() && $form->isValid()) {
            $match = new Match(
                $model->getNbCards(),
                $model->getDifficulty(),
                $model->getNbPlayers(),
                $model->getNbTeams(),
                $model->getStartedAt()
            );
            $this->entityManager->persist($match);
            $this->entityManager->flush();

            $this->drawing->drawCards($match);

            return new JsonResponse(
                $this->normalizer->toArray(
                    $match,
                    SerializationContext::create()->setGroups(['match'])
                )
            );
        }

        return new JsonResponse($this->normalizer->toArray($form->getErrors(true)));
    }
}
