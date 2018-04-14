<?php

declare(strict_types=1);

namespace App\Controller;

use App\Behavior\JsonRequestContentTrait;
use App\Entity\Match;
use App\Form\MatchType;
use App\Manager\MatchManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MatchController.
 *
 * @Route(path="/matches")
 */
class MatchController extends Controller
{
    use JsonRequestContentTrait;

    /**
     * @param Request $request
     * @Route(path="/",methods={"POST"})
     */
    public function create(Request $request, MatchManager $manager)
    {
        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);

        $form->submit($this->getJsonRequestContent($request));

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->drawCards($match);

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['success' => false], 500);
    }
}
