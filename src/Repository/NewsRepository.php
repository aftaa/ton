<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<News>
 *
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    private const INDEX_COUNT = 4;

    /**
     * @param string $locale
     * @return News[]
     */
    public function findAllByLocale(string $locale): array
    {
        $qb = $this->createQueryBuilder('n');
        if ('ru' == $locale) {
            $qb->where('n.display_ru = TRUE');
        } else {
            $qb->where('n.display_en = TRUE');
        }
        return $qb
            ->orderBy('n.NewsDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $locale
     * @return News[]
     */
    public function findForIndex(string $locale): array
    {
        $qb = $this->createQueryBuilder('n');
        if ('ru' == $locale) {
            $qb->where('n.display_ru = TRUE');
        } else {
            $qb->where('n.display_en = TRUE');
        }
        return $qb
            ->orderBy('n.NewsDate', 'DESC')
            ->setMaxResults(self::INDEX_COUNT)
            ->getQuery()
            ->getResult();
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function add(News $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(News $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return News[] Returns an array of News objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?News
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
