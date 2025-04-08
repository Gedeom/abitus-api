<?php

namespace App\Services;

use App\Contracts\FotoRepositoryInterface;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\Storage;

class FotoService extends BaseService
{
    protected $repositoryClass = FotoRepositoryInterface::class;

    public function create(array $data)
    {
        $pessoa = (new \App\Repositories\PessoaRepository)->getById($data['pes_id']);

        if (!$pessoa) {
            throw new \Exception('Pessoa não encontrada');
        }

        $path = $data['foto']->store('fotos/uploads', 's3');

        $foto = $this->repositoryClass->create([
            'pes_id' => $pessoa->pes_id,
            'fp_hash' => $path,
            'fp_data' => \Carbon\Carbon::now(),
            'fp_bucket' => env('AWS_BUCKET'),
        ]);

        return $foto;
    }

    public function delete(int $id)
    {
        $foto = $this->repositoryClass->getById($id);

        if (!$foto) {
            throw new \Exception('Foto não encontrada');
        }

        Storage::disk('s3')->delete($foto->fp_hash);

        $this->repositoryClass->delete($foto);

        return [];
    }
}
