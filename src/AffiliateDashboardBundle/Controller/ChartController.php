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
 * @Route("/{_locale}/chart")
 */
class ChartController extends Controller
{

    /**
     * Upload new sales file
     *
     * @Route("/", name="chart_overview")
     * @Method("GET")
     */
    public function overviewAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sales = $em->getRepository('AffiliateDashboardBundle:Sale')->getSalesPerMonth();

        // Chart
        $series = array(
            array('name' => 'Earnings', 'data' => array_values($sales))
        );

        $ob = new Highchart();

        $ob->chart->type('line');
        $ob->chart->renderTo('chart');

        $ob->title->text('Sales per Month');

        $ob->xAxis->categories(array_keys($sales));
        $ob->xAxis->title(array('text' => 'Month'));
        $ob->yAxis->title(array('text' => 'Euro'));

        $ob->series($series);

        return $this->render(
            'AffiliateDashboardBundle:Chart:chart.html.twig',
            array('chart' => $ob)
        );
    }

}
