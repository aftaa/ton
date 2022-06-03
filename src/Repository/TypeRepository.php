<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Type>
 *
 * @method Type|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type[]    findAll()
 * @method Type[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    public function add(Type $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Type $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Type[] Returns an array of Type objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Type
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /**
     * @param string $locale
     * @param int $labelId
     * @param int $designId
     * @return Type[]
     */
    public function findForMenu(string $locale, int $labelId, int $designId): array
    {
        $qb = $this->createQueryBuilder('t')
            ->join(Product::class, 'p', Join::WITH, 't.TypeID=p.TypeID')
            ->select('COUNT(p.ProductID) AS count, t.TypeID AS id')
            ->groupBy('t.TypeID')
            ->where('t.Visible = TRUE')
            ->orderBy('t.MenuOrder');

        if ('ru' != $locale) {
            $qb->addSelect('t.TypeNameEN AS name');
        } else {
            $qb->addSelect('t.TypeName AS name');
        }

        if ($labelId) {
            $qb->andWhere('p.CategoryID = :labelId')
                ->setParameter('labelId', $labelId);
        }

        if ($designId) {
            $qb->andWhere('p.DesignID = :designId')
                ->setParameter('designId', $designId);
        }

        return $qb->getQuery()
            ->getResult();
    }
}
