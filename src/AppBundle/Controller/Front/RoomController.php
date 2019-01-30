<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\RoomTable;
use AppBundle\Form\FrontTableOrderType;

class RoomController extends Controller
{
    /**
     * @Route("/room", name="room")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $roomTables = $em->getRepository('AppBundle:RoomTable')->findAll();
    
        return $this->render('room/index.html.twig', [
            'roomTables' => $roomTables,
        ]);
    }
    
    /**
     * @Route("/room/{id}", name="order")
     */
    public function orderAction(Request $request, RoomTable $roomTable)
    {
        $orderForm = $this->createForm(FrontTableOrderType::class);
        
        $orderForm->handleRequest($request);

        if ($orderForm->isSubmitted() && $orderForm->isValid()) {
            //$this->getContainer('toto')->createOrder($orderForm->getData());
            dump($orderForm->getData()); die;
        }
        
        return $this->render('room/order.html.twig', [
            'roomTable' => $roomTable,
            'orderForm' => $orderForm->createView(),
        ]);
    }
}
