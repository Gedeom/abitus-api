<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Pessoa;

class PessoaTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /**
     * @group Pessoa
     * Test if pessoas can be listed.
     */
    public function test_pessoa_can_be_listed(): void
    {
        $this->createPessoa(10);
        $response = $this->get('api/pessoas');
        $response->assertSuccessful();

        $response->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'pes_id',
                        'pes_nome',
                        'pes_data_nascimento',
                        'pes_sexo',
                        'pes_mae',
                        'pes_pai',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * @group Pessoa
     * Test if a pessoa can be created.
     */
    public function test_a_pessoa_can_be_created(): void
    {
        $data = [
            'pes_nome' => 'João da Silva',
            'pes_data_nascimento' => now()->format('Y-m-d'),
            'pes_sexo' => 'Masculino',
            'pes_mae' => 'Maria Oliveira',
            'pes_pai' => 'José da Silva',
        ];

        $response = $this->post('api/pessoas', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'pes_id',
            'pes_nome',
            'pes_data_nascimento',
            'pes_sexo',
            'pes_mae',
            'pes_pai',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('pessoa', ['pes_nome' => $data['pes_nome'], 'pes_id' => $response->json('data.pes_id')]);
    }

    /**
     * @group Pessoa
     * Test if a pessoa can be updated.
     */
    public function test_a_pessoa_can_be_updated(): void
    {
        $pessoas = $this->createPessoa(2);
        $pessoa = $pessoas->first();

        $data = [
            'pes_nome' => 'João da Silva 1',
            'pes_data_nascimento' => now()->format('Y-m-d'),
            'pes_sexo' => 'Masculino',
            'pes_mae' => 'Maria Oliveira',
            'pes_pai' => 'José da Silva',
        ];

        $response = $this->put("api/pessoas/{$pessoa->pes_id}",  $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'pes_id',
            'pes_nome',
            'pes_data_nascimento',
            'pes_sexo',
            'pes_mae',
            'pes_pai',
            'created_at',
            'updated_at',
        ]]);

        $response->assertJsonFragment(['pes_nome' => $data['pes_nome'], 'pes_id' => $pessoa->pes_id]);
        $this->assertDatabaseHas('pessoa', ['pes_nome' => $data['pes_nome'], 'pes_id' => $pessoa->pes_id]);
    }

    /**
     * @group Pessoa
     * Test if a pessoa can be deleted.
     */
    public function test_a_pessoa_can_be_deleted(): void
    {
        $pessoas = $this->createPessoa(2);
        $pessoa = $pessoas->first();

        $response = $this->delete("api/pessoas/{$pessoa->pes_id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('pessoa', ['pes_id' => $pessoa->pes_id, 'deleted_at' => null]);
    }

    private function createPessoa($qty = 1)
    {
        return Pessoa::factory()->count($qty)->create();
    }
}
