<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MatchController
 * @package App\Controller
 * @Route(path="/matches")
 */
class MatchController extends Controller
{
    /**
     * @param Request $request
     * @Route(path="/",methods={"POST"})
     *
     */
    public function createAction(Request $request)
    {
        return new Response('');
    }
}
