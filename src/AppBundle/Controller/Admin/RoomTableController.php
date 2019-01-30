<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\RoomTable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Roomtable controller.
 *
 * @Route("roomtable")
 */
class RoomTableController extends Controller
{
    /**
     * Lists all roomTable entities.
     *
     * @Route("/", name="roomtable_index", methods="GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $roomTables = $em->getRepository('AppBundle:RoomTable')->findAll();

        return $this->render('roomtable/index.html.twig', array(
            'roomTables' => $roomTables,
        ));
    }

    /**
     * Creates a new roomTable entity.
     *
     * @Route("/new", name="roomtable_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $roomTable = new Roomtable();
        $form = $this->createForm('AppBundle\Form\RoomTableType', $roomTable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($roomTable);
            $em->flush();

            return $this->redirectToRoute('roomtable_show', array('id' => $roomTable->getId()));
        }

        return $this->render('roomtable/new.html.twig', array(
            'roomTable' => $roomTable,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a roomTable entity.
     *
     * @Route("/{id}", name="roomtable_show", methods="GET")
     */
    public function showAction(RoomTable $roomTable)
    {
        $deleteForm = $this->createDeleteForm($roomTable);

        return $this->render('roomtable/show.html.twig', array(
            'roomTable' => $roomTable,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing roomTable entity.
     *
     * @Route("/{id}/edit", name="roomtable_edit"), methods={"GET", "POST"})
     */
    public function editAction(Request $request, RoomTable $roomTable)
    {
        $deleteForm = $this->createDeleteForm($roomTable);
        $editForm = $this->createForm('AppBundle\Form\RoomTableType', $roomTable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('roomtable_edit', array('id' => $roomTable->getId()));
        }

        return $this->render('roomtable/edit.html.twig', array(
            'roomTable' => $roomTable,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a roomTable entity.
     *
     * @Route("/{id}", name="roomtable_delete", methods="DELETE")
     */
    public function deleteAction(Request $request, RoomTable $roomTable)
    {
        $form = $this->createDeleteForm($roomTable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($roomTable);
            $em->flush();
        }

        return $this->redirectToRoute('roomtable_index');
    }

    /**
     * Creates a form to delete a roomTable entity.
     *
     * @param RoomTable $roomTable The roomTable entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RoomTable $roomTable)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('roomtable_delete', array('id' => $roomTable->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
