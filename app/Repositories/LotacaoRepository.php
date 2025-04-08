<?php

namespace App\Repositories;

use App\Models\Lotacao;
use App\Repositories\Base\BaseRepository;

class LotacaoRepository extends BaseRepository
{
    protected $entity = Lotacao::class;

    public function showByUnidade(string $unid_id)
    {
        return $this->entity::where('unid_id', $unid_id)->whereHas('pessoa.servidorEfetivo')->whereHas('unidade')->get();
    }
}
