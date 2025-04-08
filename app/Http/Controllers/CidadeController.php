<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\CidadeResource;
use App\Services\CidadeService;
use Illuminate\Http\Request;

class CidadeController extends BaseController
{
    protected $serviceClass = CidadeService::class;

    protected $resourceClass = CidadeResource::class;

    protected $rules = [
        'always' => [
            'cid_nome' => 'required|string',
            'cid_uf' => 'required|string',
        ],
    ];
}
