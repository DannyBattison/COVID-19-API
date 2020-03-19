<?php

namespace App\Repository;

use App\Entity\Region;
use App\Entity\Statistic;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Statistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statistic[]    findAll()
 * @method Statistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatisticRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statistic::class);
    }

    public function create(Region $region, DateTime $dateTime, int $confirmed, int $deaths, int $recovered): Statistic
    {
        $statistic = new Statistic();
        $statistic->setRegion($region);
        $statistic->setDatetime($dateTime);
        $statistic->setConfirmed($confirmed);
        $statistic->setDeaths($deaths);
        $statistic->setRecovered($recovered);

        $this->getEntityManager()->persist($statistic);
        $this->getEntityManager()->flush($statistic);

        return $statistic;
    }

    public function getLatestDataDate(): DateTime
    {
        $datetime = $this
            ->createQueryBuilder('s')
            ->select('MAX(s.datetime)')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult();

        return new DateTime($datetime);
    }
}
