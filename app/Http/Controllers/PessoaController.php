<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\PessoaResource;
use App\Services\PessoaService;
use Illuminate\Http\Request;

class PessoaController extends BaseController
{
    protected $serviceClass = PessoaService::class;

    protected $resourceClass = PessoaResource::class;

    protected $rules = [
        'always' => [
            'pes_nome' => 'required|string',
            'pes_data_nascimento' => 'required|date|date_format:Y-m-d',
            'pes_sexo' => 'required|string',
            'pes_mae' => 'required|string',
            'pes_pai' => 'required|string',
        ],
    ];
}
