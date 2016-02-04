<?php

namespace AffiliateDashboardBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AffiliateDashboardBundle\Entity\Blogpost;
use AffiliateDashboardBundle\Form\BlogpostType;

/**
 * Blogpost controller.
 *
 * @Route("/{_locale}/blogpost")
 */
class BlogpostController extends Controller
{
    /**
     * Lists all Blogpost entities.
     *
     * @Route("/", name="blogpost_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blogposts = $em->getRepository('AffiliateDashboardBundle:Blogpost')->findAll();

        return $this->render('AffiliateDashboardBundle:Blogpost:index.html.twig', array(
            'blogposts' => $blogposts,
        ));
    }

    /**
     * Creates a new Blogpost entity.
     *
     * @Route("/new", name="blogpost_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $blogpost = new Blogpost();
        $form = $this->createForm('AffiliateDashboardBundle\Form\BlogpostType', $blogpost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blogpost);
            $em->flush();

            return $this->redirectToRoute('blogpost_show', array('id' => $blogpost->getId()));
        }

        return $this->render('AffiliateDashboardBundle:Blogpost:new.html.twig', array(
            'blogpost' => $blogpost,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Blogpost entity.
     *
     * @Route("/{id}", name="blogpost_show")
     * @Method("GET")
     */
    public function showAction(Blogpost $blogpost)
    {
        $deleteForm = $this->createDeleteForm($blogpost);

        return $this->render('AffiliateDashboardBundle:Blogpost:show.html.twig', array(
            'blogpost' => $blogpost,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Blogpost entity.
     *
     * @Route("/{id}/edit", name="blogpost_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Blogpost $blogpost)
    {
        $deleteForm = $this->createDeleteForm($blogpost);
        $editForm = $this->createForm('AffiliateDashboardBundle\Form\BlogpostType', $blogpost);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blogpost);
            $em->flush();

            return $this->redirectToRoute('blogpost_edit', array('id' => $blogpost->getId()));
        }

        return $this->render('AffiliateDashboardBundle:Blogpost:edit.html.twig', array(
            'blogpost' => $blogpost,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Blogpost entity.
     *
     * @Route("/{id}", name="blogpost_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Blogpost $blogpost)
    {
        $form = $this->createDeleteForm($blogpost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blogpost);
            $em->flush();
        }

        return $this->redirectToRoute('blogpost_index');
    }

    /**
     * Creates a form to delete a Blogpost entity.
     *
     * @param Blogpost $blogpost The Blogpost entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Blogpost $blogpost)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blogpost_delete', array('id' => $blogpost->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
