<?php

namespace App\Repository;

use App\Entity\Country;
use App\Entity\Region;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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
}
