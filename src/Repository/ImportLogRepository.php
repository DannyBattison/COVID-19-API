<?php

namespace App\Repository;

use App\Entity\ImportLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ImportLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportLog[]    findAll()
 * @method ImportLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportLog::class);
    }

    public function create(string $name)
    {
        $importLog = new ImportLog();
        $importLog->setName($name);

        $this->getEntityManager()->persist($importLog);
        $this->getEntityManager()->flush($importLog);
    }
}
