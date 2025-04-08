<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unidade>
 */
class CidadeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cid_nome' => fake()->city(),
            'cid_uf' => fake()->randomElement(['SP', 'RJ', 'MG', 'ES', 'BA', 'CE', 'RN', 'PE', 'AL', 'SE', 'PI', 'MA', 'TO', 'GO', 'DF', 'MT', 'MS', 'PR', 'SC', 'RS']),
        ];
    }
}
