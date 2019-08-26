<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Author::class);
    }


    public function transform(Author $author)
    {
        return [
                'id'    => (int) $author->getId(),
                'name' => (string) $author->getName()
        ];
    }

    public function transformAll()
    {
        $authors = $this->findAll();
        $authorsArray = [];

        foreach ($authors as $author) {
            $authorsArray[] = $this->transform($author);
        }

        return $authorsArray;
    }
}
