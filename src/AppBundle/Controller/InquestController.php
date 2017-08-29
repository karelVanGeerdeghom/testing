<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Inquest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Inquest controller.
 *
 * @Route("inquest")
 */
class InquestController extends Controller
{
    /**
     * Lists all inquest entities.
     *
     * @Route("/", name="inquest_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $inquests = $em->getRepository('AppBundle:Inquest')->findAll();

        return $this->render('inquest/index.html.twig', array(
            'inquests' => $inquests,
        ));
    }

    /**
     * Creates a new inquest entity.
     *
     * @Route("/new", name="inquest_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $inquest = new Inquest();
        $form = $this->createForm('AppBundle\Form\InquestType', $inquest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inquest);
            $em->flush();

            return $this->redirectToRoute('inquest_show', array('id' => $inquest->getId()));
        }

        return $this->render('inquest/new.html.twig', array(
            'inquest' => $inquest,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a inquest entity.
     *
     * @Route("/{id}", name="inquest_show")
     * @Method("GET")
     */
    public function showAction(Inquest $inquest)
    {
        $deleteForm = $this->createDeleteForm($inquest);

        return $this->render('inquest/show.html.twig', array(
            'inquest' => $inquest,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing inquest entity.
     *
     * @Route("/{id}/edit", name="inquest_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Inquest $inquest)
    {
        $deleteForm = $this->createDeleteForm($inquest);
        $editForm = $this->createForm('AppBundle\Form\InquestType', $inquest);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inquest_edit', array('id' => $inquest->getId()));
        }

        return $this->render('inquest/edit.html.twig', array(
            'inquest' => $inquest,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a inquest entity.
     *
     * @Route("/{id}", name="inquest_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Inquest $inquest)
    {
        $form = $this->createDeleteForm($inquest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($inquest);
            $em->flush();
        }

        return $this->redirectToRoute('inquest_index');
    }

    /**
     * Creates a form to delete a inquest entity.
     *
     * @param Inquest $inquest The inquest entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Inquest $inquest)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inquest_delete', array('id' => $inquest->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
