<?php

namespace App\Repositories;

use App\Models\Cidade;
use App\Repositories\Base\BaseRepository;

class CidadeRepository extends BaseRepository
{
    protected $entity = Cidade::class;
}
