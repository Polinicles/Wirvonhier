<?php

namespace Tests\Wirvonhier\Application\Service\Place;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Wirvonhier\Application\Service\Place\GetPlaceByIDRequest;
use Wirvonhier\Application\Service\Place\GetPlaceByIDService;
use Wirvonhier\Domain\Entity\Place;
use Wirvonhier\Domain\Entity\Repository\PlaceRepository;

class GetPlaceByIDServiceTest extends TestCase
{

    /* @var PlaceRepository $mockPlaceRepository */
    private $mockPlaceRepository;
    /* @var Generator */
    private $faker;


    public function setUp()
    {
        $this->mockPlaceRepository      = $this->createMock(PlaceRepository::class);
        $this->faker                    = Factory::create();
    }

    /**
     * Find a Place by it's ID test
     *
     * @test
     * */
    public function try_to_get_an_place_by_id()
    {
        $service = $this->getService();
        $request = new GetPlaceByIDRequest($this->faker->randomDigit);

        $this->mockPlaceRepository
            ->expects($this->once())
            ->method('findByID')
            ->willReturn(new Place());

        $service->execute($request);
    }

    /**
     * Get a non-existing Place by it's ID test
     *
     * @test
     * @expectedException \Wirvonhier\Domain\Exception\Place\PlaceNotFoundException
     * */
    public function try_to_get_a_non_existing_place_should_throw_exception()
    {
        $service = $this->getService();
        $request = new GetPlaceByIDRequest($this->faker->randomDigit);

        $this->mockPlaceRepository
            ->expects($this->once())
            ->method('findByID')
            ->willReturn(null);

        $service->execute($request);
    }

    /**
     * @return GetPlaceByIDService
     */
    public function getService() : GetPlaceByIDService
    {
        return new GetPlaceByIDService($this->mockPlaceRepository);
    }
}