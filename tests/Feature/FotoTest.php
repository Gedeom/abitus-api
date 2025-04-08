<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Foto;
use \App\Models\Pessoa;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FotoTest extends TestCase
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
     * @group Foto
     * Test if a foto can be listed.
     */
    public function test_foto_can_be_listed(): void
    {
        $foto = $this->createFoto(1)->first();

        $response = $this->get("api/fotos/{$foto->fp_id}");
        $response->assertSuccessful();

        $response->assertJsonStructure(['data' => [
            'fp_id',
            'fp_hash',
            'fp_bucket',
            'fp_data',
            'pessoa',
            'created_at',
            'updated_at',
        ]]);
    }

    /**
     * @group Foto
     * Test if a foto can be created.
     */
    public function test_a_foto_can_be_created(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('foto.jpg');

        $data = [
            'pes_id' => $this->createPessoa()->first()->pes_id,
            'foto' => $file,
        ];

        $response = $this->post('api/fotos', $data);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => [
            'fp_id',
            'fp_hash',
            'fp_bucket',
            'fp_data',
            'pessoa',
            'created_at',
            'updated_at',
        ]]);

        $this->assertDatabaseHas('foto_pessoa', ['pes_id' => $data['pes_id']]);
    }

    /**
     * @group Foto
     * Test if a foto can be deleted.
     */
    public function test_a_foto_can_be_deleted(): void
    {
        $fotos = $this->createFoto(2);
        $foto = $fotos->first();

        $response = $this->delete("api/fotos/{$foto->fp_id}");

        $response->assertJson([]);
        $this->assertDatabaseMissing('foto_pessoa', ['fp_id' => $foto->fp_id, 'deleted_at' => null]);
    }

    private function createFoto($qty = 1)
    {
        return Foto::factory()->count($qty)->create();
    }

    private function createPessoa($qty = 1)
    {
        return Pessoa::factory()->count($qty)->create();
    }
}
