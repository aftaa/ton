<?php

namespace App\Repository;

use App\Entity\Label;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Label>
 *
 * @method Label|null find($id, $lockMode = null, $lockVersion = null)
 * @method Label|null findOneBy(array $criteria, array $orderBy = null)
 * @method Label[]    findAll()
 * @method Label[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LabelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Label::class);
    }

    public function add(Label $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Label $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Label[] Returns an array of Label objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Label
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /**
     * @param string $locale
     * @param int $typeId
     * @param int $designId
     * @return Label[]
     */
    public function findForMenu(string $locale, int $typeId, int $designId): array
    {
        $qb = $this->createQueryBuilder('l')
            ->select('COUNT(p.ProductID) AS count, l.CategoryID AS id')
            ->join(Product::class, 'p', Join::WITH, 'l.CategoryID=p.CategoryID')
            ->where('l.Visible = TRUE')
            ->orderBy('l.MenuOrder');

        if ('ru' != $locale) {
            $qb->addSelect('l.NameEN AS name');
        } else {
            $qb->addSelect('l.Name AS name');
        }

        $qb->groupBy('l.CategoryID');

        if ($typeId) {
            $qb->andWhere('p.TypeID = :typeId')
                ->setParameter('typeId', $typeId);
        }

        if ($designId) {
            $qb->andWhere('p.DesignID = :designId')
                ->setParameter('designId', $designId);
        }

        return $qb->getQuery()
            ->getResult();
    }
}
