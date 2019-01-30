<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\RoomTable;
use AppBundle\Entity\TableOrder;
use AppBundle\Entity\TableOrderLine;
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
     * @Route("/room/{id}/create-order", name="create_order")
     */
    public function createOrderAction(Request $request, RoomTable $roomTable)
    {
        $orderForm = $this->createForm(FrontTableOrderType::class);
        
        $orderForm->handleRequest($request);

        if ($orderForm->isSubmitted() && $orderForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $tableOrder = new TableOrder();
            $tableOrder->setRoomTable($roomTable);
            
            foreach ($orderForm->getData() as $category => $orderLinesData) {
                foreach ($orderLinesData as $dishId => $quantity) {
                    if (is_null($quantity) || 0 === $quantity) {
                        continue;
                    }
                    
                    $tableOrderLine = new TableOrderLine();
                    
                    $tableOrderLine
                        ->setQuantity($quantity)
                        ->setDish($em->getRepository('AppBundle:Dish')->findOneBy(['id' => $dishId]))
                        ->setTableOrder($tableOrder)
                    ;
                    
                    $em->persist($tableOrderLine);
                }   
            }

            $em->persist($tableOrder);
            $em->flush();
            
            return $this->redirectToRoute('room');
        }
        
        return $this->render('room/create_order.html.twig', [
            'roomTable' => $roomTable,
            'orderForm' => $orderForm->createView(),
        ]);
    }
    
    /**
     * @Route("/room/{id}/show-orders", name="show_orders")
     */
    public function showOrdersAction(Request $request, RoomTable $roomTable)
    {
        return $this->render('room/show_orders.html.twig', [ 
            'roomTable' => $roomTable, 
        ]);
    }
}
