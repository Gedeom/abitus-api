<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\ServidorTemporarioResource;
use App\Services\ServidorTemporarioService;
use Illuminate\Http\Request;

class ServidorTemporarioController extends BaseController
{
    protected $serviceClass = ServidorTemporarioService::class;

    protected $resourceClass = ServidorTemporarioResource::class;

    protected $rules = [
        'always' => [
            'pes_id' => 'required|integer|exists:pessoa,pes_id',
            'st_data_admissao' => 'required|date|date_format:Y-m-d'
        ],
    ];
}
