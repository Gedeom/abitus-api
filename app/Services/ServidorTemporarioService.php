<?php

namespace App\Services;

use App\Contracts\ServidorTemporarioRepositoryInterface;
use App\Services\Base\BaseService;

class ServidorTemporarioService extends BaseService
{
    protected $repositoryClass = ServidorTemporarioRepositoryInterface::class;
}
