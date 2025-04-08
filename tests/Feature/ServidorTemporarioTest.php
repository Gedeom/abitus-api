<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\ServidorTemporario;
use \App\Models\Pessoa;

class ServidorTemporarioTest extends TestCase
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
     * @group ServidorTemporario
     * Test if servidor temporarios can be listed.
     */
    public function test_servidor_temporario_can_be_listed(): void
    {
        $this->createServidorTemporario(10);
        $response = $this->get('api/servidores-temporarios');
        $response->assertSuccessful();

        $response->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'st_data_admissao',
                        'st_data_demissao',
                        'pessoa',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * @group ServidorTemporario
     * Test if a servidor temporario can be created.
     */
    public function test_a_servidor_temporario_can_be_created(): void
    {
        $pessoas = $this->createPessoa(1);
        $pessoa = $pessoas->first();

        $data = [
            'pes_id' => $pessoa->pes_id,
            'st_data_admissao' => '2021-01-01',
            'st_data_demissao' => null,
        ];

        $response = $this->post('api/servidores-temporarios', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'id',
            'st_data_admissao',
            'st_data_demissao',
            'pessoa',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('servidor_temporario', ['pes_id' => $data['pes_id'], 'st_data_admissao' => $data['st_data_admissao']]);
    }

    /**
     * @group ServidorTemporario
     * Test if a servidor temporario can be updated.
     */
    public function test_a_servidor_temporario_can_be_updated(): void
    {
        $servidoresTemporarios = $this->createServidorTemporario(2);
        $servidorTemporario = $servidoresTemporarios->first();

        $data = [
            'pes_id' => $servidorTemporario->pes_id,
            'st_data_admissao' => '2021-01-01',
            'st_data_demissao' => '2021-01-02',
        ];

        $response = $this->put("api/servidores-temporarios/{$servidorTemporario->id}",  $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'id',
            'st_data_admissao',
            'st_data_demissao',
            'pessoa',
            'created_at',
            'updated_at',
        ]]);

        $response->assertJsonFragment(['st_data_admissao' => $data['st_data_admissao'], 'id' => $servidorTemporario->id]);
        $this->assertDatabaseHas('servidor_temporario', ['st_data_admissao' => $data['st_data_admissao'], 'id' => $servidorTemporario->id]);
    }

    /**
     * @group ServidorTemporario
     * Test if a servidor temporario can be deleted.
     */
    public function test_a_servidor_temporario_can_be_deleted(): void
    {
        $servidoresTemporarios = $this->createServidorTemporario(2);
        $servidorTemporario = $servidoresTemporarios->first();

        $response = $this->delete("api/servidores-temporarios/{$servidorTemporario->id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('servidor_temporario', ['id' => $servidorTemporario->id, 'deleted_at' => null]);
    }

    private function createServidorTemporario($qty = 1)
    {
        return ServidorTemporario::factory()->count($qty)->create();
    }

    private function createPessoa($qty = 1)
    {
        return Pessoa::factory()->count($qty)->create();
    }
}
