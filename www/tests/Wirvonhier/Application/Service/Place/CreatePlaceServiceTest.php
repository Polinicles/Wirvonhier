<?php

namespace Tests\Wirvonhier\Application\Service\Place;

use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Wirvonhier\Application\Service\Place\CreatePlaceRequest;
use Wirvonhier\Application\Service\Place\CreatePlaceService;
use Wirvonhier\Domain\Entity\Place;
use Wirvonhier\Domain\Entity\Repository\PlaceRepository;
use Faker\Factory;

class CreatePlaceServiceTest extends TestCase
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
     * Save a new Place test
     *
     * @test
     * */
    public function try_to_save_a_new_place()
    {
        $service = $this->getService();
        $request = new CreatePlaceRequest(
            'concert',
            $this->faker->latitude,
            $this->faker->longitude
        );

        $this->mockPlaceRepository
            ->expects($this->once())
            ->method('save')
            ->willReturn(new Place());

        $service->execute($request);
    }

    /**
     * Find an existing place test
     *
     * @test
     * */
    public function try_to_find_an_existing_place_should_return_instance()
    {
        $service = $this->getService();
        $request = new CreatePlaceRequest(
            'concert',
            $this->faker->latitude,
            $this->faker->longitude
        );

        $this->mockPlaceRepository
            ->expects($this->once())
            ->method('findOneBy')
            ->willReturn(new Place());

        $service->execute($request);

    }

    /**
     * @return CreatePlaceService
     */
    public function getService() : CreatePlaceService
    {
        return new CreatePlaceService($this->mockPlaceRepository);
    }
}