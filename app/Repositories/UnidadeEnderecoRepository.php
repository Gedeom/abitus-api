<?php

namespace App\Repositories;

use App\Models\UnidadeEndereco;
use App\Repositories\Base\BaseRepository;

class UnidadeEnderecoRepository extends BaseRepository
{
    protected $entity = UnidadeEndereco::class;

    public function showByServidorEfetivoName(string $pes_nome)
    {
        return $this->entity::join('unidade', 'unidade_endereco.unid_id', '=', 'unidade.unid_id')
            ->join('pessoa', 'unidade.pes_id', '=', 'pessoa.pes_id')
            ->where('pessoa.pes_nome', 'like', '%' . $pes_nome . '%')
            ->join('servidor_efetivo', 'pessoa.pes_id', '=', 'servidor_efetivo.pes_id')
            ->select('unidade_endereco.*', 'pessoa.*', 'servidor_efetivo.*')
            ->get();
    }
}
