<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-1 month', '+1 month');

        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'start_date' => $date,
            'end_date' => $date,
            'priority' => fake()->numberBetween(0, 3),
        ];
    }
}