<?php

namespace Tests\Wirvonhier\Application\Service\Event;

use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Wirvonhier\Application\Service\Event\GetEventByIDRequest;
use Wirvonhier\Application\Service\Event\GetEventByIDService;
use Wirvonhier\Domain\Entity\Event;
use Wirvonhier\Domain\Entity\Repository\EventRepository;
use Faker\Factory;

class GetEventByIDServiceTest extends TestCase
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
     * Get an Event by it's ID
     *
     * @test
     * */
    public function try_to_get_an_event_by_id()
    {
        $service = $this->getService();
        $request = new GetEventByIDRequest($this->faker->randomDigit);

        $this->mockEventRepository
            ->expects($this->once())
            ->method('findByID')
            ->willReturn(new Event());

        $service->execute($request);
    }

    /**
     * Get a non-existing Event by ID test
     *
     * @test
     * @expectedException \Wirvonhier\Domain\Exception\Event\EventNotFoundException
     * */
    public function try_to_get_a_non_existing_event_should_throw_exception()
    {
        $service = $this->getService();
        $request = new GetEventByIDRequest($this->faker->randomDigit);

        $this->mockEventRepository
            ->expects($this->once())
            ->method('findByID')
            ->willReturn(null);

        $service->execute($request);
    }

    /**
     * @return GetEventByIDService
     */
    public function getService() : GetEventByIDService
    {
        return new GetEventByIDService($this->mockEventRepository);
    }
}