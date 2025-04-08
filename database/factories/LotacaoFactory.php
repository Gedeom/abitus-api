<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lotacao>
 */
class LotacaoFactory extends Factory
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
            'unid_id' => \App\Models\Unidade::factory(),
            'lot_data_lotacao' => fake()->date(),
            'lot_data_remocao' => fake()->randomElement([null, fake()->date()]),
            'lot_portaria' => fake()->numberBetween(1, 1000),
        ];
    }
}
