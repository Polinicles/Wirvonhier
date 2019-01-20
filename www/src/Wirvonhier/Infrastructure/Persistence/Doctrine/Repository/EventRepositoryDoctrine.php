<?php

namespace Wirvonhier\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Wirvonhier\Domain\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Wirvonhier\Domain\Entity\Repository\EventRepository;

class EventRepositoryDoctrine extends ServiceEntityRepository implements EventRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * EventRepositoryDoctrine constructor.
     *
     * @param RegistryInterface $registry
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(RegistryInterface $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Event::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @param $eventId
     *
     * @return Event|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findById($eventId): ?Event
    {
        $builder = $this->entityManager->createQueryBuilder();

        $builder
            ->select('e')
            ->from(Event::class, 'e')
            ->where('e.id = :eventId')
            ->setParameter('eventId', $eventId);

        return $builder->getQuery()->getOneOrNullResult();
    }
    
    /**
     * @param Event $event
     * @return null|Event
     */
    public function save(Event $event): ?Event
    {
        $this->entityManager->persist($event);
        $this->flush();

        return $event;
    }

    /**
     * Flush repository
     */
    public function flush()
    {
        $this->entityManager->flush();
    }
}