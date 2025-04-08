<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\ServidorEfetivoResource;
use App\Http\Resources\ServidorEfetivoLotadoResource;
use App\Services\ServidorEfetivoService;
use Illuminate\Http\Request;

class ServidorEfetivoController extends BaseController
{
    protected $serviceClass = ServidorEfetivoService::class;

    protected $resourceClass = ServidorEfetivoResource::class;

    protected $rules = [
        'always' => [
            'pes_id' => 'required|integer|exists:pessoa,pes_id',
            'se_matricula' => 'required|string'
        ],
    ];

    public function getByName(string $pes_nome)
    {
        $servidores = $this->serviceClass->getByName($pes_nome);

        return $this->resourceClass::collection($servidores);
    }
}
