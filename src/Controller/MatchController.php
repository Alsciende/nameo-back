<?php

declare(strict_types=1);

namespace App\Controller;

use App\Behavior\JsonRequestContentTrait;
use App\Entity\Match;
use App\Form\MatchType;
use App\Form\Model\CreateMatchModel;
use App\Manager\MatchManager;
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
     * @var MatchManager
     */
    private $manager;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ArrayTransformerInterface
     */
    private $normalizer;

    public function __construct(
        MatchManager $manager,
        EntityManagerInterface $entityManager,
        ArrayTransformerInterface $normalizer
    ) {
        $this->manager = $manager;
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

            $this->manager->drawCards($match);

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
