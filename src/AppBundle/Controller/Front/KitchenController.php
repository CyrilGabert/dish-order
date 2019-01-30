<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class KitchenController extends Controller
{
    /**
     * @Route("/kitchen", name="kitchen")
     */
    public function indexAction(Request $request)
    {
        return $this->render('kitchen/index.html.twig', []);
    }
}
