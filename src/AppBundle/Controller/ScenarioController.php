<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Scenario;
use AppBundle\Entity\ScenarioInquest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Scenario controller.
 *
 * @Route("scenario")
 */
class ScenarioController extends Controller
{
    /**
     * Lists all scenario entities.
     *
     * @Route("/", name="scenario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $scenarios = $em->getRepository('AppBundle:Scenario')->findAll();

        return $this->render('scenario/index.html.twig', array(
            'scenarios' => $scenarios,
        ));
    }

    /**
     * Creates a new scenario entity.
     *
     * @Route("/new", name="scenario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $scenario = new Scenario();

        $form = $this->createForm('AppBundle\Form\ScenarioType', $scenario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // foreach ($scenario->getScenarioInquests() as $scenarioInquest) {
            //     $em->persist($scenarioInquest);
            //     foreach ($scenarioInquest->getScenarioInquestValidators() as $scenarioInquestValidator) {
            //         $em->persist($scenarioInquestValidator);
            //     }
            // }
            $em->persist($scenario);
            $em->flush();

            return $this->redirectToRoute('scenario_show', array('id' => $scenario->getId()));
        }

        return $this->render('scenario/new.html.twig', array(
            'scenario' => $scenario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a scenario entity.
     *
     * @Route("/{id}", name="scenario_show")
     * @Method("GET")
     */
    public function showAction(Scenario $scenario)
    {
        $deleteForm = $this->createDeleteForm($scenario);

        return $this->render('scenario/show.html.twig', array(
            'scenario' => $scenario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing scenario entity.
     *
     * @Route("/{id}/edit", name="scenario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Scenario $scenario)
    {
        $deleteForm = $this->createDeleteForm($scenario);
        $editForm = $this->createForm('AppBundle\Form\ScenarioType', $scenario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('scenario_edit', array('id' => $scenario->getId()));
        }

        return $this->render('scenario/edit.html.twig', array(
            'scenario' => $scenario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a scenario entity.
     *
     * @Route("/{id}", name="scenario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Scenario $scenario)
    {
        $form = $this->createDeleteForm($scenario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($scenario);
            $em->flush();
        }

        return $this->redirectToRoute('scenario_index');
    }

    /**
     * Creates a form to delete a scenario entity.
     *
     * @param Scenario $scenario The scenario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Scenario $scenario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('scenario_delete', array('id' => $scenario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
