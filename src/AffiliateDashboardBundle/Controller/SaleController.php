<?php

namespace AffiliateDashboardBundle\Controller;

use AffiliateDashboardBundle\Service\Xmlfile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AffiliateDashboardBundle\Form\UploadType;
use AffiliateDashboardBundle\Entity\Sale;

/**
 * Sale controller.
 *
 * @Route("/{_locale}/sale")
 */
class SaleController extends Controller
{
    /**
     * Upload sales form
     *
     * @Route("/add", name="sale_add")
     */
    public function addAction(Request $request)
    {
        $xmlFile = $this->container->get('affiliate_dashboard.xml.importservice');
        $form = $this->createForm(UploadType::class, $xmlFile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $xmlFile->getData();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file
            $reportDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/reports';

            /** @var $savedFile \Symfony\Component\HttpFoundation\File\File */
            $savedFile = $file->move($reportDir, $fileName);

            $em = $this->getDoctrine()->getManager();

            foreach ($xmlFile->crawl($savedFile) as $sale) {
                $em->persist($sale);
            }

            $em->flush();

            return $this->redirectToRoute('sale_success');
        }

        return $this->render(
            'AffiliateDashboardBundle:Sale:add.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Upload new sales file
     *
     * @Route("/success", name="sale_success")
     * @Method("GET")
     */
    public function successAction()
    {
        return $this->render('AffiliateDashboardBundle:Sale:success.html.twig');
    }

    /**
     * Lists all Sale entities.
     *
     * @Route("/", name="sale_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $sales = $em->getRepository('AffiliateDashboardBundle:Sale')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $sales, /* query NOT result */
            $request->query->getInt('page', 1) /*page number*/,
            50 /*limit per page*/
        );

        return $this->render(
            'AffiliateDashboardBundle:Sale:index.html.twig',
            array(
                'pagination' => $pagination,
            )
        );
    }

    /**
     * Finds and displays a Sale entity.
     *
     * @Route("/{id}", name="sale_show")
     * @Method("GET")
     */
    public function showAction(Sale $sale)
    {
        return $this->render(
            'AffiliateDashboardBundle:Sale:show.html.twig',
            array(
                'sale' => $sale,
            )
        );
    }
}
