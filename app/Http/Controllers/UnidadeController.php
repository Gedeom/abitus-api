<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\UnidadeResource;
use App\Services\UnidadeService;
use Illuminate\Http\Request;

class UnidadeController extends BaseController
{
    protected $serviceClass = UnidadeService::class;

    protected $resourceClass = UnidadeResource::class;

    protected $rules = [
        'always' => [
            'unid_nome' => 'required|string',
            'unid_sigla' => 'required|string',
        ],
    ];
}
