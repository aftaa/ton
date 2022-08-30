<?php

namespace App\Repository;

use App\Entity\Design;
use App\Entity\Product;
use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Design>
 *
 * @method Design|null find($id, $lockMode = null, $lockVersion = null)
 * @method Design|null findOneBy(array $criteria, array $orderBy = null)
 * @method Design[]    findAll()
 * @method Design[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DesignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Design::class);
    }

    public function add(Design $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Design $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Design[] Returns an array of Design objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Design
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function findCollection(string $locale, int $typeId, int $labelId): array
    {
        $qb = $this->createQueryBuilder('d')
            ->select('d.DesignID AS id, d.ImageLO')
            ->join(Product::class, 'p', Join::WITH, 'p.DesignID=d.DesignID')
            ->join(Type::class, 't', Join::WITH, 'p.TypeID=t.TypeID')
            ->where('d.Visible = TRUE')
            ->orderBy('d.sort', 'DESC')
            ->addOrderBy('d.DBDate')
            ->groupBy('d.DesignID');

        if ('ru' != $locale) {
            $qb->addSelect('d.DesignNameEN AS name');
        } else {
            $qb->addSelect('d.DesignName AS name');
        }

        if ($labelId) {
            $qb->andWhere('d.CategoryID = :labelId')
                ->setParameter('labelId', $labelId);
        }

        if ($typeId) {
            $qb->andWhere('t.TypeID = :typeId')
                ->setParameter('typeId', $typeId);
        }

        return $qb->getQuery()->getResult();
    }
}
