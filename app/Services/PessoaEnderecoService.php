<?php

namespace App\Services;

use App\Contracts\PessoaEnderecoRepositoryInterface;
use App\Services\Base\BaseService;

class PessoaEnderecoService extends BaseService
{
    protected $repositoryClass = PessoaEnderecoRepositoryInterface::class;
}
