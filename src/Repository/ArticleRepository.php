<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{

    public function getActive()
    {
        return $this->createQueryBuilder('s')
            ->where('s.status = :status')->setParameter('status', "ACTIF")
            ->orderBy('s.designation', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
