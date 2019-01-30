<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Dish;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Dish controller.
 *
 * @Route("dish")
 */
class DishController extends Controller
{
    /**
     * Lists all dish entities.
     *
     * @Route("/", name="dish_index", methods="GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dishes = $em->getRepository('AppBundle:Dish')->findAll();

        return $this->render('dish/index.html.twig', array(
            'dishes' => $dishes,
        ));
    }

    /**
     * Creates a new dish entity.
     *
     * @Route("/new", name="dish_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $dish = new Dish();
        $form = $this->createForm('AppBundle\Form\DishType', $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dish);
            $em->flush();

            return $this->redirectToRoute('dish_show', array('id' => $dish->getId()));
        }

        return $this->render('dish/new.html.twig', array(
            'dish' => $dish,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dish entity.
     *
     * @Route("/{id}", name="dish_show", methods="GET")
     */
    public function showAction(Dish $dish)
    {
        $deleteForm = $this->createDeleteForm($dish);

        return $this->render('dish/show.html.twig', array(
            'dish' => $dish,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dish entity.
     *
     * @Route("/{id}/edit", name="dish_edit"), methods={"GET", "POST"})
     */
    public function editAction(Request $request, Dish $dish)
    {
        $deleteForm = $this->createDeleteForm($dish);
        $editForm = $this->createForm('AppBundle\Form\DishType', $dish);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dish_edit', array('id' => $dish->getId()));
        }

        return $this->render('dish/edit.html.twig', array(
            'dish' => $dish,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dish entity.
     *
     * @Route("/{id}", name="dish_delete", methods="DELETE")
     */
    public function deleteAction(Request $request, Dish $dish)
    {
        $form = $this->createDeleteForm($dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dish);
            $em->flush();
        }

        return $this->redirectToRoute('dish_index');
    }

    /**
     * Creates a form to delete a dish entity.
     *
     * @param Dish $dish The dish entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dish $dish)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dish_delete', array('id' => $dish->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
