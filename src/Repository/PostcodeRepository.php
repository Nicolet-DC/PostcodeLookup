<?php

namespace App\Repository;

use App\Entity\Postcode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Postcode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Postcode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Postcode[]    findAll()
 * @method Postcode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostcodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Postcode::class);
    }


    /**
     * @param string $postcode
     * @return Postcode[] Returns an array of Postcode objects
     */
    public function findByPartialPostcode(string $postcode):array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.postcode LIKE :val')
            ->setParameter('val', $postcode)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param $postcode
     * @return Postcode|null
     */
    public function findOneByPostcode($postcode): ?Postcode
    {
        try {
            return $this->createQueryBuilder('p')
                ->andWhere('p.postcode = :val')
                ->setParameter('val', $postcode)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $exception) {
            return null;
        }
    }
}
