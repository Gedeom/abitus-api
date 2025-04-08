<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\PessoaEndereco;

class PessoaEnderecoTest extends TestCase
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
     * @group PessoaEndereco
     * Test if pessoa enderecos can be listed.
     */
    public function test_pessoa_endereco_can_be_listed(): void
    {
        $this->createPessoaEndereco(10);
        $response = $this->get('api/pessoas-enderecos');
        $response->assertSuccessful();

        $response->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'pessoa',
                        'endereco',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * @group PessoaEndereco
     * Test if a pessoa endereco can be created.
     */
    public function test_a_pessoa_endereco_can_be_created(): void
    {
        $data = [
            'pes_id' => $this->createPessoa()->first()->pes_id,
            'end_id' => $this->createEndereco()->first()->end_id,
        ];

        $response = $this->post('api/pessoas-enderecos', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'id',
            'pessoa',
            'endereco',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('pessoa_endereco', ['pes_id' => $data['pes_id'], 'end_id' => $data['end_id']]);
    }

    /**
     * @group PessoaEndereco
     * Test if a pessoa endereco can be updated.
     */
    public function test_a_pessoa_endereco_can_be_updated(): void
    {
        $pessoaEnderecos = $this->createPessoaEndereco(2);
        $pessoaEndereco = $pessoaEnderecos->first();

        $data = [
            'pes_id' => $pessoaEndereco->pes_id,
            'end_id' => $pessoaEndereco->end_id,
        ];

        $response = $this->put("api/pessoas-enderecos/{$pessoaEndereco->id}",  $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'id',
            'pessoa',
            'endereco',
            'created_at',
            'updated_at',
        ]]);

        $response->assertJsonFragment(['pes_id' => $data['pes_id'], 'end_id' => $data['end_id'], 'id' => $pessoaEndereco->id]);
        $this->assertDatabaseHas('pessoa_endereco', ['pes_id' => $data['pes_id'], 'end_id' => $data['end_id'], 'id' => $pessoaEndereco->id]);
    }

    /**
     * @group PessoaEndereco
     * Test if a pessoa endereco can be deleted.
     */
    public function test_a_pessoa_endereco_can_be_deleted(): void
    {
        $pessoaEnderecos = $this->createPessoaEndereco(2);
        $pessoaEndereco = $pessoaEnderecos->first();

        $response = $this->delete("api/pessoas-enderecos/{$pessoaEndereco->id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('pessoa_endereco', ['id' => $pessoaEndereco->id, 'deleted_at' => null]);
    }

    private function createPessoaEndereco($qty = 1)
    {
        return PessoaEndereco::factory()->count($qty)->create();
    }

    private function createPessoa($qty = 1)
    {
        return Pessoa::factory()->count($qty)->create();
    }

    private function createEndereco($qty = 1)
    {
        return Endereco::factory()->count($qty)->create();
    }
}
