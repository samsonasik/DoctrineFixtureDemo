<?php

namespace DoctrineFixtureDemo\Repository;

use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{
    /**
     * Get Latest News.
     *
     * @param int $limit
     *
     * @return array
     */
    public function getLatestNews($limit)
    {
        $result = $this->createQueryBuilder('n')
                       ->setFirstResult(0)
                       ->setMaxResults($limit)
                       ->getQuery()->getResult();

        return $result;
    }
}
