<?php

namespace App\Repositories;

use App\Models\PessoaEndereco;
use App\Repositories\Base\BaseRepository;

class PessoaEnderecoRepository extends BaseRepository
{
    protected $entity = PessoaEndereco::class;
}
