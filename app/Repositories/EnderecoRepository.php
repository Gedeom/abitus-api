<?php

namespace App\Repositories;

use App\Models\Endereco;
use App\Repositories\Base\BaseRepository;

class EnderecoRepository extends BaseRepository
{
    protected $entity = Endereco::class;
}
