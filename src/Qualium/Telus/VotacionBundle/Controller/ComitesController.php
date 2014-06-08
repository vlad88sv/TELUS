<?php

namespace Qualium\Telus\VotacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Qualium\Telus\VotacionBundle\Entity\Comites;
use Qualium\Telus\VotacionBundle\Form\ComitesType;

/**
 * Comites controller.
 *
 */
class ComitesController extends Controller
{

    /**
     * Lists all Comites entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QualiumTelusVotacionBundle:Comites')->findAll();

        return $this->render('QualiumTelusVotacionBundle:Comites:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Comites entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Comites();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comites_show', array('id' => $entity->getId())));
        }

        return $this->render('QualiumTelusVotacionBundle:Comites:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Comites entity.
    *
    * @param Comites $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Comites $entity)
    {
        $form = $this->createForm(new ComitesType(), $entity, array(
            'action' => $this->generateUrl('comites_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Comites entity.
     *
     */
    public function newAction()
    {
        $entity = new Comites();
        $form   = $this->createCreateForm($entity);

        return $this->render('QualiumTelusVotacionBundle:Comites:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Comites entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QualiumTelusVotacionBundle:Comites')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comites entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QualiumTelusVotacionBundle:Comites:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Comites entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QualiumTelusVotacionBundle:Comites')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comites entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QualiumTelusVotacionBundle:Comites:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Comites entity.
    *
    * @param Comites $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Comites $entity)
    {
        $form = $this->createForm(new ComitesType(), $entity, array(
            'action' => $this->generateUrl('comites_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Comites entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QualiumTelusVotacionBundle:Comites')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comites entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('comites_edit', array('id' => $id)));
        }

        return $this->render('QualiumTelusVotacionBundle:Comites:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Comites entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('QualiumTelusVotacionBundle:Comites')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comites entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comites'));
    }

    /**
     * Creates a form to delete a Comites entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comites_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
