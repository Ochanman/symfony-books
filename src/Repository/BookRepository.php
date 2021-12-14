<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
        // je créé la methode searchByTitle pour faire la requete sql en prenant la variable $word qui est
        // le resultat de l'input "q"
    public function searchByTitle($word) {


        // je demande à Doctrine de créer une requête SQL
        // qui fait une requête SELECT sur la table book
        // à condition que le titre du book
        // contiennent le contenu de $word (à un endroit ou à un autre, grâce à LIKE %xxxx%)
        $queryBuilder = $this->createQueryBuilder('book');

        // la requete sql s'execute et je recupère le resultat dans la variable $query
        $query = $queryBuilder->select('book')
            ->where('book.title LIKE :word')
            ->setParameter('word', '%'.$word.'%')
            ->getQuery();

            // je retourne le resultat via la methode getResult()
        return $query->getResult();

    }
}