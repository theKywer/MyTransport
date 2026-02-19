<?php

namespace Database\Factories;

use App\Models\User;
use App\Enum\TransportType;
use App\Models\Transport\Transport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Фабрика модели {@see Transport}
 */
class TransportFactory extends Factory
{
    protected $model = Transport::class;

    public function definition(): array
    {
        return [
            'user_id'               => User::factory(),
            'type_id'               => $this->faker->randomElement(TransportType::cases()),
            'name'                  => $this->faker->words(2, true),
            'vin'                   => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'year'                  => $this->faker->numberBetween(1990, 2025),
            'brand'                 => $this->faker->company(),
            'model'                 => $this->faker->word(),
            'mileage'               => $this->faker->numberBetween(0, 300000),
            'average_consumption'   => $this->faker->randomFloat(2, 5.0, 25.0),
        ];
    }

    /**
     * Создание объекта с {@see Transport::type_id} = {@see TransportType::CAR}
     *
     * @return static
     */ 
    public function car(): static
    {
        return $this->state(['type_id' => TransportType::CAR]);
    }

    /**
     * Создание объекта с {@see Transport::type_id} = {@see TransportType::TRUCK}
     *
     * @return static
     */ 
    public function truck(): static
    {
        return $this->state(['type_id' => TransportType::TRUCK]);
    }

    /**
     * Создание объекта с {@see Transport::type_id} = {@see TransportType::MOTO}
     *
     * @return static
     */ 
    public function moto(): static
    {
        return $this->state(['type_id' => TransportType::MOTO]);
    }

    /**
     * Создание объекта с {@see Transport::type_id} = {@see TransportType::BUS}
     *
     * @return static
     */ 
    public function bus(): static
    {
        return $this->state(['type_id' => TransportType::BUS]);
    }
}
