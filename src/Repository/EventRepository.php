<?php

namespace App\Repository;

use App\Entity\Event;
use App\Entity\EventSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
     * @param EventSearch $search
     *
     * @return Query
     */
    public function findAllQuery(EventSearch $search): Query
    {
        $query = $this->findNotExpiredQuery();

        if ($search->getTexte()) {
            $texte = '%'. $search->getTexte() .'%';
            $query = $query
                ->andWhere('e.title LIKE :texte OR e.description LIKE :texte')
                ->setParameter('texte', $texte);
        }

        if ($search->getStart()) {
            $dateStart = $search->getStart()->format('Y-m-d 00:00:00');
            $query = $query
                ->andWhere('e.start >= :date_start OR (e.start < :date_start AND e.end >= :date_start)')
                ->setParameter('date_start', $dateStart);
        }

        if ($search->getEnd()) {
            $dateEnd = $search->getEnd()->format('Y-m-d 23:59:59');
            $query = $query
                ->andWhere('e.start <= :date_end OR (e.start < :date_end AND e.end >= :date_end)')
                ->setParameter('date_end', $dateEnd);
        }

        if ($search->getCategories()) {
            $query = $query
                ->andWhere(':category = e.category')
                ->setParameter('category', $search->getCategories());
        }

        if ($search->getCities()) {
            $query = $query
                ->andWhere(':city = e.city')
                ->setParameter('city', $search->getCities());
        }

        return $query->getQuery();
    }

    private function findNotExpiredQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.start >= CURRENT_DATE() OR (e.start < CURRENT_DATE() AND e.end >= CURRENT_DATE())')
            ->orderBy('e.start', 'ASC');
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
