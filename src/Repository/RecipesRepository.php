<?php

namespace App\Repository;

use App\Entity\Recipes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipes[]    findAll()
 * @method Recipes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Recipes[]    findById(int $id)
 */
class RecipesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipes::class);
    }

    /**
     * @return Recipes[]
     */
    
    /*public function findById($id): array
    {
    	$entityManager = $this->getEntityManager();
    	$query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Recipes p
            WHERE p.id > :id'            
        )->setParameter('id', $id);
        return $query->getResult();
    }*/
    
    public function findById($value): ?Recipes
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :id')
            ->setParameter('id', $value)
            ->getQuery()
            //->getResult()
        ;
    }
}
