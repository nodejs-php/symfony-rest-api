<?php

namespace App\Repository;

use App\Dto\Page;
use App\Dto\PokemonSummaryDto;
use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Pokemon>
 *
 * @method Pokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pokemon[]    findAll()
 * @method Pokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    public function findByKeyword(string $q, int $offset = 0, int $limit = 20): Page
    {
        $query = $this->createQueryBuilder("p")
            ->andWhere("p.title like :q or p.content like :q")
            ->setParameter('q', "%" . $q . "%")
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery();

        $paginator = new Paginator($query, $fetchJoinCollection = false);
        $c = count($paginator);
        $content = new ArrayCollection();
        foreach ($paginator as $post) {
            $content->add(PokemonSummaryDto::of($post->getId(), $post->getTitle()));
        }
        return Page::of ($content, $c, $offset, $limit);
    }


//    /**
//     * @return Pokemon[] Returns an array of Pokemon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pokemon
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
