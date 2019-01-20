<?php

namespace Tests\Wirvonhier\Application\Service\Event;

use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Wirvonhier\Application\Service\Event\CreateEventRequest;
use Wirvonhier\Application\Service\Event\CreateEventService;
use Wirvonhier\Application\Service\Place\GetPlaceByIDService;
use Wirvonhier\Domain\Entity\Event;
use Wirvonhier\Domain\Entity\Repository\EventRepository;
use Faker\Factory;

class CreateEventServiceTest extends TestCase
{

    /* @var EventRepository $mockEventRepository */
    private $mockEventRepository;

    /* @var GetPlaceByIDService $mockGetPlaceByIDService */
    private $mockGetPlaceByIDService;

    /* @var Generator */
    private $faker;

    public function setUp()
    {
        $this->mockEventRepository      = $this->createMock(EventRepository::class);
        $this->mockGetPlaceByIDService  = $this->createMock(GetPlaceByIDService::class);
        $this->faker                    = Factory::create();
    }

    /**
     * Save a new Event instance test
     *
     * @test
     * */
    public function try_to_save_a_new_event()
    {
        $service = $this->getService();

        $request = new CreateEventRequest(
            'concert',
            $this->faker->randomDigit);

        $this->mockEventRepository
                ->expects($this->once())
                ->method('save')
                ->willReturn(new Event());

        $service->execute($request);
    }

    /**
     * @return CreateEventService
     */
    public function getService() : CreateEventService
    {
        return new CreateEventService(
            $this->mockGetPlaceByIDService,
            $this->mockEventRepository
        );
    }
}