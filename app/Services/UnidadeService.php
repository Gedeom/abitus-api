<?php

namespace App\Services;

use App\Contracts\UnidadeRepositoryInterface;
use App\Services\Base\BaseService;

class UnidadeService extends BaseService
{
    protected $repositoryClass = UnidadeRepositoryInterface::class;
}
