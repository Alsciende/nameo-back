<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MatchController.
 *
 * @Route(path="/matches")
 */
class MatchController extends Controller
{
    /**
     * @param Request $request
     * @Route(path="/",methods={"POST"})
     */
    public function createAction(Request $request)
    {
        return new Response('');
    }
}
