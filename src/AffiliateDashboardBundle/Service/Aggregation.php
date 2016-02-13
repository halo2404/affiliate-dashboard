<?php

namespace AffiliateDashboardBundle\Service;

use AffiliateDashboardBundle\Entity\Tag;
use Doctrine\ORM\EntityManager;

class Aggregation
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    public function reAggregateTags($tags)
    {
        /** @var $tag Tag */
        foreach ($tags as $tag) {
            $tag->setAggregatedEarnings($tag->getEarnings(true));
        }
    }
}