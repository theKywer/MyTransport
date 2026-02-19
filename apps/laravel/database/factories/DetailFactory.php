<?php

namespace Database\Factories;

use App\Models\Event\Detail;
use App\Models\Event\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Фабрика модели {@see Detail}
 */
class DetailFactory extends Factory
{

    protected $model = Detail::class;

    
    public function definition()
    {
        return [
            'name' => fake()->words(2, true),
            'work' => fake()->numberBetween(1000, 10000),
            'resource' => fake()->numberBetween(1000, 10000),
            'total' => fake()->numberBetween(1000, 10000),
            'description' => fake()->sentence(),
        ];
    }

    /**
     * Создание объектов модели {@see Resource}
     *
     * @param integer $count Количество создаваемых объектов
     * @return static
     */
    public function withResources(int $count = 1): static
    {
        return $this->has(
            Resource::factory()->count($count),
            'resources'
        );
    }
}
