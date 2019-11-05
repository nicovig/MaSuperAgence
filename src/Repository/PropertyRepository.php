<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }



     /**
      * @return Property[]
      */
    public function findAllVisible(): array {

        return $this->findVisibleQuery()
            //get query
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery(PropertySearch $propertySearch): Query {

                  //get only Query object
        $query =  $this->findVisibleQuery();

        if($propertySearch->getMaxPrice()){
            //                                      no injections allows
            $query = $query->andWhere('p.price <= :maxprice')
                           ->setParameter('maxprice', $propertySearch->getMaxPrice());
        }
        if($propertySearch->getMinSurface()){
            $query = $query->andWhere('p.surface >= :minsurface')
                           ->setParameter('minsurface', $propertySearch->getMinSurface());
        }

            return $query->getQuery();
    }

    /**
     * @return Property[]
     */
    public function findLatest(): array {

        return $this->findVisibleQuery()
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;
    }

    private function findVisibleQuery():QueryBuilder {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false')
            ;
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
