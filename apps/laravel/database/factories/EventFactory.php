<?php

namespace Database\Factories;

use App\Enum\EventType;
use App\Models\Event\Event;
use App\Models\Event\Detail;
use App\Models\Event\Resource;
use App\Models\Transport\Transport;
use Database\Factories\DetailFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Фабрика для модели {@see Event}
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'transport_id' => Transport::factory(),
            'type_id' => fake()->randomElement(EventType::cases()),
            'mileage' => fake()->numberBetween(0, 300000),
            'work' => fake()->numberBetween(1000, 10000),
            'resource' => fake()->numberBetween(1000, 10000),
            'total' => fake()->numberBetween(2000, 20000),
            'location' => fake()->city(),
            'description' => fake()->sentence(),
        ];
    }

    /**
     * Создание объектов модели {@see Detail}
     *
     * @param integer $count Количество создаваемых объектов
     * @return static
     */
    public function withDetails(int $count = 1): static
    {
        return $this->has(
            Detail::factory()->count($count)->make(),
            'details'
        );
    }

    /**
     * Создание объектов модели {@see Detail} с объектами модели {@see Resource}
     *
     * @param integer $detailsCount Количество создаваемых объектов {@see Detail}
     * @param integer $resourcesCount Количество создаваемых объектов {@see Resource}
     * @return static
     */
    public function withDetailsAndResources(int $detailsCount = 1, int $resourcesCount = 1): static
    {
        return $this->has(
            Detail::factory()->count($detailsCount)->has(
                Resource::factory()->count($resourcesCount),
                'resources'
            ),
            'details'
        );
    }

}
