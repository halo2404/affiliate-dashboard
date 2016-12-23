<?php

namespace AffiliateDashboardBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AffiliateDashboardBundle\Entity\Tag;
use AffiliateDashboardBundle\Form\TagType;

/**
 * Tag controller.
 *
 * @Route("/{_locale}/tag")
 */
class TagController extends Controller
{
    /**
     * Lists all Tag entities.
     *
     * @Route("/", name="tag_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('AffiliateDashboardBundle:Tag')->findAllOrderBySaleCount();

        return $this->render(
            'AffiliateDashboardBundle:Tag:index.html.twig',
            array(
                'tags' => $tags,
            )
        );
    }

    /**
     * Creates a new Tag entity.
     *
     * @Route("/new", name="tag_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm('AffiliateDashboardBundle\Form\TagType', $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'AffiliateDashboardBundle:Tag:new.html.twig',
            array(
                'tag' => $tag,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing Tag entity.
     *
     * @Route("/{id}/edit", name="tag_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tag $tag)
    {
        $editForm = $this->createForm('AffiliateDashboardBundle\Form\TagType', $tag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'AffiliateDashboardBundle:Tag:edit.html.twig',
            array(
                'tag' => $tag,
                'edit_form' => $editForm->createView()
            )
        );
    }

}
