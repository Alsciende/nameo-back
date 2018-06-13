<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(path="/dummy")
 */
class DummyController extends Controller
{
    /**
     * @return Response
     * @Route(path="/")
     */
    public function dummy()
    {
        return new Response('');
    }
}
