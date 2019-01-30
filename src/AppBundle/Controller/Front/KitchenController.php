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
        $em = $this->getDoctrine()->getManager();
        $tableOrders = $em->getRepository('AppBundle:TableOrder')->findBy(
            [],
            ['createdAt' => 'DESC']
        );
        
        return $this->render('kitchen/index.html.twig', [
            'tableOrders' => $tableOrders,
        ]);
    }
}
