<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PessoaEndereco>
 */
class PessoaEnderecoFactory extends Factory
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
            'end_id' => \App\Models\Endereco::factory(),
        ];
    }
}
