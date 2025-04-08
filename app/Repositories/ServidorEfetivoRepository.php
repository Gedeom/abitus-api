<?php

namespace App\Repositories;

use App\Models\ServidorEfetivo;
use App\Models\Pessoa;
use App\Repositories\Base\BaseRepository;

class ServidorEfetivoRepository extends BaseRepository
{
    protected $entity = ServidorEfetivo::class;


    public function getByName(string $pes_nome)
    {
        return $this->entity::with('lotacaoAtiva')
            ->whereHas('pessoa', function ($query) use ($pes_nome) {
                $query->where('pes_nome', 'LIKE', '%' . $pes_nome . '%');
            })->get();

        // return Pessoa::with('servidorEfetivo.lotacaoAtiva')->where('pes_nome', 'LIKE', '%' . $pes_nome . '%')->get();
    }
}
