<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WaterData>
 */
class WaterDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'water_source' => $this->faker->randomElement(['PDAM', 'Sumur', 'Sungai', 'Air Hujan']),
            'water_ph' => $this->faker->randomFloat(2, 0, 14),
            'water_temperature' => $this->faker->randomFloat(2, 0, 100),
            'turbidity' => $this->faker->randomFloat(2, 0, 100),
            'ambient_temperature' => $this->faker->randomFloat(2, 0, 100),
            'ambient_humidity' => $this->faker->randomFloat(2, 0, 100),
            'eligibility' => $this->faker->boolean,
            'water_status' => $this->faker->randomElement(['Layak', 'Tidak Layak']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
