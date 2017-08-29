<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Validator controller.
 *
 * @Route("validator")
 */
class ValidatorController extends Controller
{
    /**
     * Lists all validator entities.
     *
     * @Route("/", name="validator_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $validators = $em->getRepository('AppBundle:Validator')->findAll();

        return $this->render('validator/index.html.twig', array(
            'validators' => $validators,
        ));
    }

    /**
     * Creates a new validator entity.
     *
     * @Route("/new", name="validator_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $validator = new Validator();
        $form = $this->createForm('AppBundle\Form\ValidatorType', $validator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($validator);
            $em->flush();

            return $this->redirectToRoute('validator_show', array('id' => $validator->getId()));
        }

        return $this->render('validator/new.html.twig', array(
            'validator' => $validator,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a validator entity.
     *
     * @Route("/{id}", name="validator_show")
     * @Method("GET")
     */
    public function showAction(Validator $validator)
    {
        $deleteForm = $this->createDeleteForm($validator);

        return $this->render('validator/show.html.twig', array(
            'validator' => $validator,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing validator entity.
     *
     * @Route("/{id}/edit", name="validator_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Validator $validator)
    {
        $deleteForm = $this->createDeleteForm($validator);
        $editForm = $this->createForm('AppBundle\Form\ValidatorType', $validator);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('validator_edit', array('id' => $validator->getId()));
        }

        return $this->render('validator/edit.html.twig', array(
            'validator' => $validator,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a validator entity.
     *
     * @Route("/{id}", name="validator_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Validator $validator)
    {
        $form = $this->createDeleteForm($validator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($validator);
            $em->flush();
        }

        return $this->redirectToRoute('validator_index');
    }

    /**
     * Creates a form to delete a validator entity.
     *
     * @param Validator $validator The validator entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Validator $validator)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('validator_delete', array('id' => $validator->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
