<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\UnidadeEnderecoResource;
use App\Services\UnidadeEnderecoService;
use Illuminate\Http\Request;

class UnidadeEnderecoController extends BaseController
{
    protected $serviceClass = UnidadeEnderecoService::class;

    protected $resourceClass = UnidadeEnderecoResource::class;

    protected $rules = [
        'always' => [
            'unid_id' => 'required|integer|exists:unidade,unid_id',
            'end_id' => 'required|integer|exists:endereco,end_id',
        ],
    ];

    public function showByServidorEfetivoName(string $pes_nome)
    {
        $unidade = $this->serviceClass->showByServidorEfetivoName($pes_nome);

        return $this->resourceClass::collection($unidade);
    }
}
