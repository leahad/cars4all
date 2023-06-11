<?php

namespace App\Repository;

use App\Entity\CarCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarCategory>
 *
 * @method CarCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarCategory[]    findAll()
 * @method CarCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarCategory::class);
    }

    public function save(CarCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
