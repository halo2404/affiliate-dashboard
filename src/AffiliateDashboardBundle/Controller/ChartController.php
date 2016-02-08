<?php

namespace AffiliateDashboardBundle\Controller;

use AffiliateDashboardBundle\Entity\Tag;
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
     * Sales per month overview
     *
     * @Route("/", name="chart_overview")
     * @Method("GET")
     */
    public function overviewAction()
    {
        $em = $this->getDoctrine()->getManager();
        $translator = $this->get('translator');

        $sales = $em->getRepository('AffiliateDashboardBundle:Sale')->getSalesPerMonth();

        // Chart
        $series = array(
            array('name' => $translator->trans('Earnings'), 'data' => array_values($sales))
        );

        $ob = new Highchart();

        $ob->chart->type('line');
        $ob->chart->renderTo('chart');

        $ob->title->text($translator->trans('Sales per month'));

        $ob->xAxis->categories(array_keys($sales));
        $ob->xAxis->title(array('text' => $translator->trans('Month')));
        $ob->yAxis->title(array('text' => $translator->trans('Euro')));

        $ob->series($series);

        return $this->render(
            'AffiliateDashboardBundle:Chart:chart.html.twig',
            array('chart' => $ob)
        );
    }

    /**
     * Sales per tag
     *
     * @Route("/tag/{id}", name="chart_tag")
     * @Method("GET")
     */
    public function tagAction(Tag $tag)
    {
        $em = $this->getDoctrine()->getManager();
        $translator = $this->get('translator');

        $sales = $em->getRepository('AffiliateDashboardBundle:Sale')->getSalesPerDay($tag);

        // Chart
        $series = array(
            array('name' => $translator->trans('Earnings'), 'data' => array_values($sales))
        );

        $ob = new Highchart();

        $ob->chart->type('line');
        $ob->chart->renderTo('chart');

        $ob->title->text($translator->trans('Sales per day'));
        $ob->subtitle->text($tag->getName());

        $ob->xAxis->categories(array_keys($sales));
        $ob->xAxis->title(array('text' => $translator->trans('Day')));
        $ob->yAxis->title(array('text' => $translator->trans('Euro')));

        $ob->series($series);

        return $this->render(
            'AffiliateDashboardBundle:Chart:chart.html.twig',
            array('chart' => $ob)
        );
    }

    /**
     * Sales per month overview
     *
     * @Route("/tags", name="chart_tags")
     * @Method("GET")
     */
    public function tagsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $translator = $this->get('translator');

        $tags = $em->getRepository('AffiliateDashboardBundle:Tag')->findAll();

        // Chart
        $series = array();
        $keys = array();

        /** @var $tag Tag */
        foreach ($tags as $tag) {
            $sales = $em->getRepository('AffiliateDashboardBundle:Sale')->getSalesPerDay($tag);
            $series[] = array(
                'name' => $tag->getName(),
                'data' => $sales
            );
            $keys = array_unique(array_merge($keys, array_keys($sales)));
        }

        sort($keys);

        // Fill missing values with 0
        foreach ($series as $key => $serie) {
            $series[$key]['data'] = array_values(
                array_replace(array_fill_keys($keys, array(0)), $serie['data'])
            );
        }

        $ob = new Highchart();

        $ob->chart->type('line');
        $ob->chart->renderTo('chart');

        $ob->title->text($translator->trans('Sales per day'));

        $ob->xAxis->categories($keys);
        $ob->xAxis->title(array('text' => $translator->trans('Day')));
        $ob->xAxis->type('date');
        $ob->yAxis->title(array('text' => $translator->trans('Euro')));

        $ob->series($series);

        return $this->render(
            'AffiliateDashboardBundle:Chart:chart.html.twig',
            array('chart' => $ob)
        );
    }
}
