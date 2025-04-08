<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'end_tipo_logradouro' => fake()->randomElement(['Rua', 'Avenida', 'Travessa', 'Estrada']),
            'end_logradouro' => fake()->streetName(),
            'end_numero' => fake()->buildingNumber(),
            'end_bairro' => fake()->name(),
            'cid_id' => \App\Models\Cidade::factory(),
        ];
    }
}
