<?php

namespace App\Services;

use App\Contracts\CidadeRepositoryInterface;
use App\Services\Base\BaseService;

class CidadeService extends BaseService
{
    protected $repositoryClass = CidadeRepositoryInterface::class;
}
