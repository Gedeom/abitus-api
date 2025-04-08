<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Unidade;
use \App\Models\UnidadeEndereco;
use \App\Models\Endereco;

class UnidadeEnderecoTest extends TestCase
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
     * @group UnidadeEndereco
     * Test if unidade enderecos can be listed.
     */
    public function test_unidade_endereco_can_be_listed(): void
    {
        $this->createUnidadeEndereco(10);
        $response = $this->get('api/unidades-enderecos');
        $response->assertSuccessful();

        $response->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'unid_id',
                        'endereco',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * @group UnidadeEndereco
     * Test if a unidade endereco can be created.
     */
    public function test_a_unidade_endereco_can_be_created(): void
    {
        $data = [
            'unid_id' => $this->createUnidade()->first()->unid_id,
            'end_id' => $this->createEndereco()->first()->end_id,
        ];

        $response = $this->post('api/unidades-enderecos', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'id',
            'unid_id',
            'endereco',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('unidade_endereco', ['unid_id' => $data['unid_id'], 'end_id' => $data['end_id']]);
    }

    /**
     * @group UnidadeEndereco
     * Test if a unidade endereco can be updated.
     */
    public function test_a_unidade_endereco_can_be_updated(): void
    {
        $unidadeEnderecos = $this->createUnidadeEndereco(2);
        $unidadeEndereco = $unidadeEnderecos->first();

        $data = [
            'unid_id' => $unidadeEndereco->unid_id,
            'end_id' => $unidadeEndereco->end_id,
        ];

        $response = $this->put("api/unidades-enderecos/{$unidadeEndereco->id}",  $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'id',
            'unid_id',
            'endereco',
            'created_at',
            'updated_at',
        ]]);

        $response->assertJsonFragment(['unid_id' => $data['unid_id'], 'end_id' => $data['end_id'], 'id' => $unidadeEndereco->id]);
        $this->assertDatabaseHas('unidade_endereco', ['unid_id' => $data['unid_id'], 'end_id' => $data['end_id'], 'id' => $unidadeEndereco->id]);
    }

    /**
     * @group UnidadeEndereco
     * Test if a unidade endereco can be deleted.
     */
    public function test_a_unidade_endereco_can_be_deleted(): void
    {
        $unidadeEnderecos = $this->createUnidadeEndereco(2);
        $unidadeEndereco = $unidadeEnderecos->first();

        $response = $this->delete("api/unidades-enderecos/{$unidadeEndereco->id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('unidade_endereco', ['id' => $unidadeEndereco->id, 'deleted_at' => null]);
    }

    private function createUnidadeEndereco($qty = 1)
    {
        return UnidadeEndereco::factory()->count($qty)->create();
    }

    private function createUnidade($qty = 1)
    {
        return Unidade::factory()->count($qty)->create();
    }

    private function createEndereco($qty = 1)
    {
        return Endereco::factory()->count($qty)->create();
    }
}
