<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class SupplyingRepository extends EntityRepository
{

    public function getOngoing()
    {
        return $this->createQueryBuilder('s')
            ->where('s.supplyDate is null')
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
