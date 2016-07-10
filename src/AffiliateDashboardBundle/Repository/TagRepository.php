<?php

namespace AffiliateDashboardBundle\Repository;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends \Doctrine\ORM\EntityRepository
{
    public function findbyName($name)
    {
        return $this->findOneByName($name);
    }

    public function findAllOrderBySaleCount()
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.sales', 's')
            ->addSelect('COUNT(s) AS salesCount')
            ->groupBy('t')
            ->orderBy('salesCount', 'DESC')
            ->getQuery()
            ->getResult();
    }
}