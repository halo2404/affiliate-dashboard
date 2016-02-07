<?php

namespace AffiliateDashboardBundle\Controller;

use AffiliateDashboardBundle\Service\Xmlfile;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AffiliateDashboardBundle\Form\Upload;
use AffiliateDashboardBundle\Entity\Sale;

/**
 * Sale controller.
 *
 * @Route("/")
 */
class IndexController extends Controller
{
    /**
     * Sales per month overview
     *
     * @Route("/", name="index_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render(
            'AffiliateDashboardBundle:Index:index.html.twig'
        );
    }

    /** from Controller
     *
     * @Route("/language/{locale}", name="index_language")
     *
     */
    public function changeLanguageAction(Request $request, $locale){
        $request->attributes->set('_locale', null);
        $this->get('session')->set('_locale', $locale);

        return $this->redirect($this->generateUrl('index_index'));
    }
}