<?php

namespace App\Services;

use App\Contracts\LotacaoRepositoryInterface;
use App\Services\Base\BaseService;

class LotacaoService extends BaseService
{
    protected $repositoryClass = LotacaoRepositoryInterface::class;

    public function showByUnidade(string $unid_id)
    {
        return $this->repositoryClass->showByUnidade($unid_id);
    }
}
