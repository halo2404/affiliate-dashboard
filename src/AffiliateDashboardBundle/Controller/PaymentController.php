<?php

namespace AffiliateDashboardBundle\Controller;

use AffiliateDashboardBundle\Entity\Payment;
use AffiliateDashboardBundle\Entity\Tag;
use AffiliateDashboardBundle\Entity\User;
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
 * @Route("/{_locale}/payment")
 */
class PaymentController extends Controller
{
    /**
     * Payment overview
     *
     * @Route("/", name="payment_index")
     * @Method("GET")
     */
    public function overviewAction()
    {
        $em = $this->getDoctrine()->getManager();

        $payments = $em->getRepository('AffiliateDashboardBundle:Payment')->findAll();

        return $this->render(
            'AffiliateDashboardBundle:Payment:index.html.twig',
            array(
                'payments' => $payments,
            )
        );
    }

    /**
     * Clear payments
     *
     * @Route("/clear", name="payment_clear")
     * @Method("GET")
     */
    public function clearAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AffiliateDashboardBundle:User')->findAll();
        $clearedSales = array();

        /** @var User $user */
        foreach ($users as $user) {
            // Collect information
            $sum = 0;

            foreach ($user->getBlogpostUser() as $bu) {
                $tag = $bu->getBlogpost()->getAffiliateTag();
                $sum += $tag->getEarnings(true, true) / count($tag->getBlogposts()) / 100 * $bu->getPercentage();

                foreach ($tag->getSales() as $sale) {
                    if (!$sale->getCleared()) {
                        $clearedSales[$sale->getId()] = $sale;
                    }
                }
            }

            // Create payment
            if ($sum > 0) {
                $payment = new Payment();
                $payment->setUser($user);
                $payment->setAmount($sum);
                $payment->setDate(new \DateTime(date('Y-m-d H:i:s')));

                $em->persist($payment);
            }
        }

        /** @var Sale $sale */
        foreach ($clearedSales as $sale) {
            $sale->setCleared(true);
            $em->persist($sale);
        }

        $em->flush();

        return $this->redirectToRoute('payment_index');
    }
}