<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Endereco;
use \App\Models\Cidade;

class EnderecoTest extends TestCase
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
     * @group Endereco
     * Test if enderecos can be listed.
     */
    public function test_endereco_can_be_listed(): void
    {
        $this->createEndereco(10);
        $response = $this->get('api/enderecos');
        $response->assertSuccessful();

        $response->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'end_id',
                        'end_tipo_logradouro',
                        'end_logradouro',
                        'end_numero',
                        'end_bairro',
                        'cidade',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * @group Endereco
     * Test if a endereco can be created.
     */
    public function test_a_endereco_can_be_created(): void
    {
        $cidades = $this->createCidade(2);
        $cidade = $cidades->first();

        $data = [
            'end_tipo_logradouro' => 'Rua',
            'end_logradouro' => 'Rua das Flores',
            'end_numero' => '123',
            'end_bairro' => 'Bairro das Flores',
            'cid_id' => $cidade->cid_id,
        ];

        $response = $this->post('api/enderecos', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'end_id',
            'end_tipo_logradouro',
            'end_logradouro',
            'end_numero',
            'end_bairro',
            'cidade',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('endereco', ['end_tipo_logradouro' => $data['end_tipo_logradouro'], 'end_id' => $response->json('data.end_id')]);
    }

    /**
     * @group Endereco
     * Test if a endereco can be updated.
     */
    public function test_a_endereco_can_be_updated(): void
    {
        $enderecos = $this->createEndereco(2);
        $endereco = $enderecos->first();

        $data = [
            'end_tipo_logradouro' => 'Rua',
            'end_logradouro' => 'Rua das Flores',
            'end_numero' => '123',
            'end_bairro' => 'Bairro das Flores',
            'cid_id' => $endereco->cid_id,
        ];

        $response = $this->put("api/enderecos/{$endereco->end_id}",  $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'end_id',
            'end_tipo_logradouro',
            'end_logradouro',
            'end_numero',
            'end_bairro',
            'cidade',
            'created_at',
            'updated_at',
        ]]);

        $response->assertJsonFragment(['end_tipo_logradouro' => $data['end_tipo_logradouro'], 'end_id' => $endereco->end_id]);
        $this->assertDatabaseHas('endereco', ['end_tipo_logradouro' => $data['end_tipo_logradouro'], 'end_id' => $endereco->end_id]);
    }

    /**
     * @group Endereco
     * Test if a endereco can be deleted.
     */
    public function test_a_endereco_can_be_deleted(): void
    {
        $enderecos = $this->createEndereco(2);
        $endereco = $enderecos->first();

        $response = $this->delete("api/enderecos/{$endereco->end_id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('endereco', ['end_id' => $endereco->end_id, 'deleted_at' => null]);
    }

    private function createEndereco($qty = 1)
    {
        return Endereco::factory()->count($qty)->create();
    }

    private function createCidade($qty = 1)
    {
        return Cidade::factory()->count($qty)->create();
    }
}
