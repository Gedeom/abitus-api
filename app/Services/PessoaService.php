<?php

namespace App\Services;

use App\Contracts\PessoaRepositoryInterface;
use App\Services\Base\BaseService;

class PessoaService extends BaseService
{
    protected $repositoryClass = PessoaRepositoryInterface::class;
}
