<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Foto>
 */
class FotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fp_hash' => fake()->name(),
            'fp_bucket' => fake()->randomElement(['public', 'private']),
            'fp_data' => fake()->date(),
            'pes_id' => \App\Models\Pessoa::factory(),
        ];
    }
}
