<?php

namespace Wirvonhier\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Wirvonhier\Domain\Entity\Place;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Wirvonhier\Domain\Entity\Repository\PlaceRepository;

class PlaceRepositoryDoctrine extends ServiceEntityRepository implements PlaceRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * PlaceRepositoryDoctrine constructor.
     *
     * @param RegistryInterface $registry
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(RegistryInterface $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Place::class);
        $this->entityManager = $entityManager;
    }

    /**
     * Find Place by it's ID
     *
     * @param $placeId
     * @return Place|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findById($placeId): ?Place
    {
        $builder = $this->entityManager->createQueryBuilder();

        $builder
            ->select('p')
            ->from(Place::class, 'p')
            ->where('p.id = :placeId')
            ->setParameter('placeId', $placeId);

        return $builder->getQuery()->getOneOrNullResult();
    }
    
    /**
     * @param Place $place
     * @return null|Place
     */
    public function save(Place $place): ?Place
    {
        $this->entityManager->persist($place);
        $this->flush();

        return $place;
    }

    /**
     * Flush repository
     */
    public function flush()
    {
        $this->entityManager->flush();
    }
}