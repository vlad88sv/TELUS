<?php

namespace Qualium\Telus\VotacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Qualium\Telus\VotacionBundle\Entity\Candidatos;
use Qualium\Telus\VotacionBundle\Form\CandidatosType;

/**
 * Candidatos controller.
 *
 */
class CandidatosController extends Controller
{

    /**
     * Lists all Candidatos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QualiumTelusVotacionBundle:Candidatos')->findAll();

        return $this->render('QualiumTelusVotacionBundle:Candidatos:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Candidatos entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Candidatos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('candidatos_show', array('id' => $entity->getId())));
        }

        return $this->render('QualiumTelusVotacionBundle:Candidatos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Candidatos entity.
    *
    * @param Candidatos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Candidatos $entity)
    {
        $form = $this->createForm(new CandidatosType(), $entity, array(
            'action' => $this->generateUrl('candidatos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Candidatos entity.
     *
     */
    public function newAction()
    {
        $entity = new Candidatos();
        $form   = $this->createCreateForm($entity);

        return $this->render('QualiumTelusVotacionBundle:Candidatos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Candidatos entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QualiumTelusVotacionBundle:Candidatos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Candidatos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QualiumTelusVotacionBundle:Candidatos:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Candidatos entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QualiumTelusVotacionBundle:Candidatos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Candidatos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QualiumTelusVotacionBundle:Candidatos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Candidatos entity.
    *
    * @param Candidatos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Candidatos $entity)
    {
        $form = $this->createForm(new CandidatosType(), $entity, array(
            'action' => $this->generateUrl('candidatos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Candidatos entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QualiumTelusVotacionBundle:Candidatos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Candidatos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('candidatos_edit', array('id' => $id)));
        }

        return $this->render('QualiumTelusVotacionBundle:Candidatos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Candidatos entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('QualiumTelusVotacionBundle:Candidatos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Candidatos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('candidatos'));
    }

    /**
     * Creates a form to delete a Candidatos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('candidatos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
