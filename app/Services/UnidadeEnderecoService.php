<?php

namespace App\Services;

use App\Contracts\UnidadeEnderecoRepositoryInterface;
use App\Services\Base\BaseService;

class UnidadeEnderecoService extends BaseService
{
    protected $repositoryClass = UnidadeEnderecoRepositoryInterface::class;

    public function showByServidorEfetivoName(string $pes_nome)
    {
        return $this->repositoryClass->showByServidorEfetivoName($pes_nome);
    }
}
