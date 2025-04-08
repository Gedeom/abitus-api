<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\EnderecoResource;
use App\Services\EnderecoService;
use Illuminate\Http\Request;

class EnderecoController extends BaseController
{
    protected $serviceClass = EnderecoService::class;

    protected $resourceClass = EnderecoResource::class;

    protected $rules = [
        'always' => [
            'end_tipo_logradouro' => 'required|string',
            'end_logradouro' => 'required|string',
            'end_numero' => 'required|string',
            'end_bairro' => 'required|string',
            'cid_id' => 'required|exists:cidade,cid_id',
        ],
    ];
}
