<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\LotacaoResource;
use App\Services\LotacaoService;
use Illuminate\Http\Request;

class LotacaoController extends BaseController
{
    protected $serviceClass = LotacaoService::class;

    protected $resourceClass = LotacaoResource::class;

    protected $rules = [
        'always' => [
            'pes_id' => 'required|integer|exists:pessoa,pes_id',
            'unid_id' => 'required|integer|exists:unidade,unid_id',
            'lot_data_lotacao' => 'required|date|date_format:Y-m-d',
            'lot_data_remocao' => 'sometimes|nullable|date|date_format:Y-m-d',
            'lot_portaria' => 'required|string',
        ],
    ];

    public function showByUnidade(string $unid_id)
    {
        $lotacoes = $this->serviceClass->showByUnidade($unid_id);

        return $this->resourceClass::collection($lotacoes);
    }
}
