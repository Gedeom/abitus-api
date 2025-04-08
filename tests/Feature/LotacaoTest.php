<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Unidade;
use \App\Models\Lotacao;
use \App\Models\Pessoa;

class LotacaoTest extends TestCase
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
     * @group Lotacao
     * Test if lotacoes can be listed.
     */
    public function test_lotacao_can_be_listed(): void
    {
        $this->createLotacao(10);
        $response = $this->get('api/lotacoes');
        $response->assertSuccessful();

        $response->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'lot_id',
                        'pessoa',
                        'unidade',
                        'lot_data_lotacao',
                        'lot_data_remocao',
                        'lot_portaria',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * @group Lotacao
     * Test if a lotacao can be created.
     */
    public function test_a_lotacao_can_be_created(): void
    {
        $data = [
            'pes_id' => $this->createPessoa()->first()->pes_id,
            'unid_id' => $this->createUnidade()->first()->unid_id,
            'lot_data_lotacao' => now()->format('Y-m-d'),
            'lot_data_remocao' => now()->addDays(30)->format('Y-m-d'),
            'lot_portaria' => '1234567890',
        ];

        $response = $this->post('api/lotacoes', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'lot_id',
            'pessoa',
            'unidade',
            'lot_data_lotacao',
            'lot_data_remocao',
            'lot_portaria',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('lotacao', ['pes_id' => $data['pes_id'], 'unid_id' => $data['unid_id']]);
    }

    /**
     * @group Lotacao
     * Test if a lotacao can be updated.
     */
    public function test_a_lotacao_can_be_updated(): void
    {
        $lotacoes = $this->createLotacao(2);
        $lotacao = $lotacoes->first();

        $data = [
            'pes_id' => $lotacao->pes_id,
            'unid_id' => $lotacao->unid_id,
            'lot_data_lotacao' => now()->format('Y-m-d'),
            'lot_data_remocao' => now()->addDays(30)->format('Y-m-d'),
            'lot_portaria' => '1234567890',
        ];

        $response = $this->put("api/lotacoes/{$lotacao->lot_id}",  $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'lot_id',
            'pessoa',
            'unidade',
            'lot_data_lotacao',
            'lot_data_remocao',
            'lot_portaria',
            'created_at',
            'updated_at',
        ]]);

        $response->assertJsonFragment(['pes_id' => $data['pes_id'], 'unid_id' => $data['unid_id'], 'lot_id' => $lotacao->lot_id]);
        $this->assertDatabaseHas('lotacao', ['pes_id' => $data['pes_id'], 'unid_id' => $data['unid_id'], 'lot_id' => $lotacao->lot_id]);
    }

    /**
     * @group Lotacao
     * Test if a lotacao can be deleted.
     */
    public function test_a_lotacao_can_be_deleted(): void
    {
        $lotacoes = $this->createLotacao(2);
        $lotacao = $lotacoes->first();

        $response = $this->delete("api/lotacoes/{$lotacao->lot_id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('lotacao', ['lot_id' => $lotacao->lot_id, 'deleted_at' => null]);
    }

    private function createLotacao($qty = 1)
    {
        return Lotacao::factory()->count($qty)->create();
    }

    private function createUnidade($qty = 1)
    {
        return Unidade::factory()->count($qty)->create();
    }

    private function createPessoa($qty = 1)
    {
        return Pessoa::factory()->count($qty)->create();
    }
}
