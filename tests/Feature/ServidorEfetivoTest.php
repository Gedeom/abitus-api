<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\ServidorEfetivo;
use \App\Models\Pessoa;

class ServidorEfetivoTest extends TestCase
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
     * @group ServidorEfetivo
     * Test if servidor efetivos can be listed.
     */
    public function test_servidor_efetivo_can_be_listed(): void
    {
        $this->createServidorEfetivo(10);
        $response = $this->get('api/servidores-efetivos');
        $response->assertSuccessful();

        $response->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'se_matricula',
                        'lotacao',
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
        $pessoas = $this->createPessoa(1);
        $pessoa = $pessoas->first();

        $data = [
            'pes_id' => $pessoa->pes_id,
            'se_matricula' => '1234567890',
        ];

        $response = $this->post('api/servidores-efetivos', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'id',
            'se_matricula',
            'lotacao',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('servidor_efetivo', ['pes_id' => $data['pes_id'], 'se_matricula' => $data['se_matricula']]);
    }

    /**
     * @group ServidorEfetivo
     * Test if a servidor efetivo can be updated.
     */
    public function test_a_servidor_efetivo_can_be_updated(): void
    {
        $servidoresEfetivos = $this->createServidorEfetivo(2);
        $servidorEfetivo = $servidoresEfetivos->first();

        $data = [
            'pes_id' => $servidorEfetivo->pes_id,
            'se_matricula' => '12345678903',
        ];

        $response = $this->put("api/servidores-efetivos/{$servidorEfetivo->id}",  $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'id',
            'se_matricula',
            'lotacao',
            'created_at',
            'updated_at',
        ]]);

        $response->assertJsonFragment(['se_matricula' => $data['se_matricula'], 'id' => $servidorEfetivo->id]);
        $this->assertDatabaseHas('servidor_efetivo', ['se_matricula' => $data['se_matricula'], 'id' => $servidorEfetivo->id]);
    }

    /**
     * @group ServidorEfetivo
     * Test if a servidor efetivo can be deleted.
     */
    public function test_a_servidor_efetivo_can_be_deleted(): void
    {
        $servidoresEfetivos = $this->createServidorEfetivo(2);
        $servidorEfetivo = $servidoresEfetivos->first();

        $response = $this->delete("api/servidores-efetivos/{$servidorEfetivo->id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('servidor_efetivo', ['id' => $servidorEfetivo->id, 'deleted_at' => null]);
    }

    private function createServidorEfetivo($qty = 1)
    {
        return ServidorEfetivo::factory()->count($qty)->create();
    }

    private function createPessoa($qty = 1)
    {
        return Pessoa::factory()->count($qty)->create();
    }
}
