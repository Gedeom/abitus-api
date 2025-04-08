<?php

namespace App\Services;

use App\Contracts\EnderecoRepositoryInterface;
use App\Services\Base\BaseService;

class EnderecoService extends BaseService
{
    protected $repositoryClass = EnderecoRepositoryInterface::class;
}
