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
 * @Route("/chart")
 */
class ChartController extends Controller
{

    /**
     * Upload new sales file
     *
     * @Route("/overview", name="chart_overview")
     * @Method("GET")
     */
    public function overviewAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sales = $em->getRepository('AffiliateDashboardBundle:Sale')->getSalesPerMonth();

        // Chart
        $series = array(
            array('name' => 'Sales per Month', 'data' => $sales)
        );

        $ob = new Highchart();

        $ob->chart->renderTo('linechart'); // The #id of the div where to render the chart

        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text' => 'Horizontal axis title'));
        $ob->yAxis->title(array('text' => 'Vertical axis title'));

        $ob->series($series);

        return $this->render(
            'AffiliateDashboardBundle:Chart:overview.html.twig',
            array('chart' => $ob)
        );
    }

}
