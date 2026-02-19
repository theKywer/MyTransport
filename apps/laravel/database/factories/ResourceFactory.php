<?php

namespace Database\Factories;

use App\Models\Event\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Фабрика модели {@see Resource}
 */
class ResourceFactory extends Factory
{
    protected $model = Resource::class;
    
    public function definition()
    {
        return [
            'name' => fake()->words(3, true),
            'article' => fake()->word(),
            'count' => fake()->numberBetween(1, 10),
            'price' => fake()->randomFloat(2, 100, 10000),
            'description' => fake()->sentence()
        ];
    }
}
