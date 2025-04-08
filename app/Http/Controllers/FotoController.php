<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\FotoResource;
use App\Services\FotoService;
use Illuminate\Http\Request;

class FotoController extends BaseController
{
    protected $serviceClass = FotoService::class;

    protected $resourceClass = FotoResource::class;

    protected $rules = [
        'always' => [
            'foto' => 'required|image',
            'pes_id' => 'required|integer|exists:pessoa,pes_id',
        ],
    ];
}
