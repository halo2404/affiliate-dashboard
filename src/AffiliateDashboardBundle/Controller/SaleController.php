<?php

namespace AffiliateDashboardBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AffiliateDashboardBundle\Entity\Sale;

/**
 * Sale controller.
 *
 * @Route("/sale")
 */
class SaleController extends Controller
{
    /**
     * Upload sales form
     *
     * @Route("/", name="sale_add")
     * @Method("GET")
     */
    public function addAction()
    {
        $form = $this->createFormBuilder()
            ->add('xml_file', FileType::class)
            ->add('save', SubmitType::class, array('label' => 'Upload file'))
            ->getForm();

        return $this->render('AffiliateDashboardBundle:Sale:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Upload new sales file
     *
     * @Route("/", name="sale_upload")
     * @Method("POST")
     */
    public function uploadAction()
    {

    }

    /**
     * Lists all Sale entities.
     *
     * @Route("/", name="sale_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sales = $em->getRepository('AffiliateDashboardBundle:Sale')->findAll();

        return $this->render('AffiliateDashboardBundle:Sale:index.html.twig', array(
            'sales' => $sales,
        ));
    }

    /**
     * Finds and displays a Sale entity.
     *
     * @Route("/{id}", name="sale_show")
     * @Method("GET")
     */
    public function showAction(Sale $sale)
    {
        return $this->render('AffiliateDashboardBundle:Sale:show.html.twig', array(
            'sale' => $sale,
        ));
    }
}
