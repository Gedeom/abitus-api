<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServidorTemporario>
 */
class ServidorTemporarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pes_id' => \App\Models\Pessoa::factory(),
            'st_data_admissao' => fake()->date(),
            'st_data_demissao' => fake()->randomElement([null, fake()->date()]),
        ];
    }
}
