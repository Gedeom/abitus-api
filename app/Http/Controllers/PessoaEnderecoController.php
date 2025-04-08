<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\PessoaEnderecoResource;
use App\Services\PessoaEnderecoService;
use Illuminate\Http\Request;

class PessoaEnderecoController extends BaseController
{
    protected $serviceClass = PessoaEnderecoService::class;

    protected $resourceClass = PessoaEnderecoResource::class;

    protected $rules = [
        'always' => [
            'pes_id' => 'required|integer|exists:pessoa,pes_id',
            'end_id' => 'required|integer|exists:endereco,end_id',
        ],
    ];
}
