<?php

namespace Qualium\Telus\VotacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Qualium\Telus\VotacionBundle\Entity\Documentos;
use Qualium\Telus\VotacionBundle\Form\DocumentosType;

/**
 * Documentos controller.
 *
 */
class DocumentosController extends Controller
{

    /**
     * Lists all Documentos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QualiumTelusVotacionBundle:Documentos')->findAll();

        return $this->render('QualiumTelusVotacionBundle:Documentos:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Documentos entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Documentos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('documentos_show', array('id' => $entity->getId())));
        }

        return $this->render('QualiumTelusVotacionBundle:Documentos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Documentos entity.
    *
    * @param Documentos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Documentos $entity)
    {
        $form = $this->createForm(new DocumentosType(), $entity, array(
            'action' => $this->generateUrl('documentos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Documentos entity.
     *
     */
    public function newAction()
    {
        $entity = new Documentos();
        $form   = $this->createCreateForm($entity);

        return $this->render('QualiumTelusVotacionBundle:Documentos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Documentos entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QualiumTelusVotacionBundle:Documentos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documentos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QualiumTelusVotacionBundle:Documentos:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Documentos entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QualiumTelusVotacionBundle:Documentos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documentos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QualiumTelusVotacionBundle:Documentos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Documentos entity.
    *
    * @param Documentos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Documentos $entity)
    {
        $form = $this->createForm(new DocumentosType(), $entity, array(
            'action' => $this->generateUrl('documentos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Documentos entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QualiumTelusVotacionBundle:Documentos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documentos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('documentos_edit', array('id' => $id)));
        }

        return $this->render('QualiumTelusVotacionBundle:Documentos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Documentos entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('QualiumTelusVotacionBundle:Documentos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Documentos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('documentos'));
    }

    /**
     * Creates a form to delete a Documentos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('documentos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
