<?php

namespace App\Repository;

use App\Entity\Country;
use App\Entity\Region;
use App\Entity\Statistic;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Region|null find($id, $lockMode = null, $lockVersion = null)
 * @method Region|null findOneBy(array $criteria, array $orderBy = null)
 * @method Region[]    findAll()
 * @method Region[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Region::class);
    }

    public function findOrCreate(Country $country, string $name, ?float $latitude, ?float $longitude): Region
    {
        $region = $this->findOneBy([
            'country' => $country,
            'name' => $name,
        ]);

        if (!$region) {
            $region = new Region();
            $region->setCountry($country);
            $region->setName($name);
            $this->getEntityManager()->persist($region);
        }

        $region->setLatitude($latitude);
        $region->setLongitude($longitude);

        $this->getEntityManager()->flush($region);

        return $region;
    }

    public function getStatisticsForDate(?DateTime $datetime): array
    {
        $minDate = $datetime->setTime(0, 0, );
        $maxDate = (clone $datetime)->setTime(23, 59, 59);

        $minDate->setTime(0, 0, 0);
        $maxDate->setTime(23, 59, 59);
        return $this
            ->createQueryBuilder('r')
            ->select('c.name as countryName, r.name as regionName, r.latitude, r.longitude, s.confirmed, s.deaths, s.recovered, s.datetime')
            ->leftJoin('r.country', 'c')
            ->leftJoin('r.statistics', 's')
            ->andWhere('s.datetime BETWEEN :minDate and :maxDate')
            ->setParameter('minDate', $minDate)
            ->setParameter('maxDate', $maxDate)
            ->getQuery()
            ->getScalarResult();
    }
}
