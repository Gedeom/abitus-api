<?php

namespace App\Services;

use App\Contracts\ServidorEfetivoRepositoryInterface;
use App\Services\Base\BaseService;

class ServidorEfetivoService extends BaseService
{
    protected $repositoryClass = ServidorEfetivoRepositoryInterface::class;

    public function getByName(string $pes_nome)
    {
        return $this->repositoryClass->getByName($pes_nome);
    }
}
