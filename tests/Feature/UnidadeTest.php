<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Unidade;

class UnidadeTest extends TestCase
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
     * @group Unidade
     * Test if unidades can be listed.
     */
    public function test_unidade_can_be_listed(): void
    {
        $this->createUnidade(10);
        $response = $this->get('api/unidades');
        $response->assertSuccessful();

        $response->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'unid_id',
                        'unid_nome',
                        'unid_sigla',
                        'endereco',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * @group Unidade
     * Test if a unidade can be created.
     */
    public function test_a_unidade_can_be_created(): void
    {
        $data = [
            'unid_nome' => 'João da Silva',
            'unid_sigla' => 'João da Silva',
        ];

        $response = $this->post('api/unidades', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'unid_id',
            'unid_nome',
            'unid_sigla',
            'endereco',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('unidade', ['unid_nome' => $data['unid_nome'], 'unid_id' => $response->json('data.unid_id')]);
    }

    /**
     * @group Unidade
     * Test if a unidade can be updated.
     */
    public function test_a_unidade_can_be_updated(): void
    {
        $unidades = $this->createUnidade(2);
        $unidade = $unidades->first();

        $data = [
            'unid_nome' => 'João da Silva 1',
            'unid_sigla' => 'João da Silva 1',
        ];

        $response = $this->put("api/unidades/{$unidade->unid_id}",  $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'unid_id',
            'unid_nome',
            'unid_sigla',
            'endereco',
            'created_at',
            'updated_at',
        ]]);

        $response->assertJsonFragment(['unid_nome' => $data['unid_nome'], 'unid_id' => $unidade->unid_id]);
        $this->assertDatabaseHas('unidade', ['unid_nome' => $data['unid_nome'], 'unid_id' => $unidade->unid_id]);
    }

    /**
     * @group Unidade
     * Test if a unidade can be deleted.
     */
    public function test_a_unidade_can_be_deleted(): void
    {
        $unidades = $this->createUnidade(2);
        $unidade = $unidades->first();

        $response = $this->delete("api/unidades/{$unidade->unid_id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('unidade', ['unid_id' => $unidade->unid_id, 'deleted_at' => null]);
    }

    private function createUnidade($qty = 1)
    {
        return Unidade::factory()->count($qty)->create();
    }
}
