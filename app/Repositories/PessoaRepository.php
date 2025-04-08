<?php

namespace App\Repositories;

use App\Models\Pessoa;
use App\Repositories\Base\BaseRepository;

class PessoaRepository extends BaseRepository
{
    protected $entity = Pessoa::class;
}
