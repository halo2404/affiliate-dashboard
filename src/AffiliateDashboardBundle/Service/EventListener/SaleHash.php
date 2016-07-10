<?php

namespace AffiliateDashboardBundle\Service\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AffiliateDashboardBundle\Entity\Sale;

class SaleHash
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // only act on some "Product" entity
        if ($entity instanceof Sale) {

            $hash = md5(
                $entity->getAffiliateTag()->getName() .
                $entity->getAsin() .
                $entity->getCategory() .
                $entity->getDate()->format('Y-m-d H:i:s') .
                $entity->getEarnings() .
                $entity->getLinkType() .
                $entity->getRate() .
                $entity->getPrice() .
                $entity->getQty() .
                $entity->getRevenue() .
                $entity->getTitle() .
                $entity->getSeller()
            );

            $entity->setHash($hash);
        }
    }
}