<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Cidade;

class CidadeTest extends TestCase
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
     * @group Cidade
     * Test if cidades can be listed.
     */
    public function test_cidade_can_be_listed(): void
    {
        $this->createCidade(10);
        $response = $this->get('api/cidades');
        $response->assertSuccessful();

        $response->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'cid_id',
                        'cid_nome',
                        'cid_uf',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * @group Cidade
     * Test if a cidade can be created.
     */
    public function test_a_cidade_can_be_created(): void
    {
        $data = [
            'cid_nome' => 'São Paulo',
            'cid_uf' => 'SP',
        ];

        $response = $this->post('api/cidades', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'cid_id',
            'cid_nome',
            'cid_uf',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('cidade', ['cid_nome' => $data['cid_nome'], 'cid_uf' => $data['cid_uf']]);
    }

    /**
     * @group Cidade
     * Test if a cidade can be updated.
     */
    public function test_a_cidade_can_be_updated(): void
    {
        $cidades = $this->createCidade(2);
        $cidade = $cidades->first();

        $data = [
            'cid_nome' => 'São Paulo',
            'cid_uf' => 'SP',
        ];

        $response = $this->put("api/cidades/{$cidade->cid_id}",  $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'cid_id',
            'cid_nome',
            'cid_uf',
            'created_at',
            'updated_at',
        ]]);

        $response->assertJsonFragment(['cid_nome' => $data['cid_nome'], 'cid_uf' => $data['cid_uf'], 'cid_id' => $cidade->cid_id]);
        $this->assertDatabaseHas('cidade', ['cid_nome' => $data['cid_nome'], 'cid_uf' => $data['cid_uf'], 'cid_id' => $cidade->cid_id]);
    }

    /**
     * @group Cidade
     * Test if a cidade can be deleted.
     */
    public function test_a_cidade_can_be_deleted(): void
    {
        $cidades = $this->createCidade(2);
        $cidade = $cidades->first();

        $response = $this->delete("api/cidades/{$cidade->cid_id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('cidade', ['cid_id' => $cidade->cid_id, 'deleted_at' => null]);
    }

    private function createCidade($qty = 1)
    {
        return Cidade::factory()->count($qty)->create();
    }
}
