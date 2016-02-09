<?php

namespace AffiliateDashboardBundle\Service;

class TwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('propertySum', array($this, 'propertySum')),
        );
    }

    public function propertySum($collection, $property)
    {
        $sum = 0;
        $method = 'get' . ucfirst($property);

        foreach ($collection as $item) {
            if (method_exists($item, $method)) {
                $sum += call_user_func(array($item, $method));
            }
        }

        return $sum;
    }

    public function getName()
    {
        return 'affiliate_dashboard';
    }
}