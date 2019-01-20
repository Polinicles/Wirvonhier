<?php

namespace Tests\Wirvonhier\Application\Service\Event;

use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Wirvonhier\Application\Service\Event\GetEventsByRadiusRequest;
use Wirvonhier\Application\Service\Event\GetEventsByRadiusService;
use Wirvonhier\Domain\Entity\Event;
use Wirvonhier\Domain\Entity\Place;
use Wirvonhier\Domain\Entity\Repository\EventRepository;
use Faker\Factory;

class GetEventsByRadiusServiceTest extends TestCase
{
    /* @var EventRepository $mockEventRepository */
    private $mockEventRepository;
    /* @var Generator */
    private $faker;


    public function setUp()
    {
        $this->mockEventRepository      = $this->createMock(EventRepository::class);
        $this->faker                    = Factory::create();
    }

    /**
     * Find events withing certain radius (in km's) test
     *
     * @test
     * */
    public function try_to_find_events_within_a_radius()
    {
        $service = $this->getService();

        $request = new GetEventsByRadiusRequest(
            $this->faker->randomDigit,
            $this->faker->latitude,
            $this->faker->longitude
        );

        $place   = $this->buildPlace();
        $event   = new Event();
        $event->setType($this->faker->name);
        $event->setPlace($place);

        $this->mockEventRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn([$event]);

        $service->execute($request);
    }

    /**
     * @return GetEventsByRadiusService
     */
    public function getService() : GetEventsByRadiusService
    {
        return new GetEventsByRadiusService($this->mockEventRepository);
    }

    /**
     * @return Place
     */
    public function buildPlace() : Place
    {
        $place = new Place();
        $place->setType($this->faker->name);
        $place->setLatitude($this->faker->latitude);
        $place->setLongitude($this->faker->longitude);

        return $place;
    }
}