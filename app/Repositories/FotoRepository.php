<?php

namespace App\Repositories;

use App\Models\Foto;
use App\Repositories\Base\BaseRepository;

class FotoRepository extends BaseRepository
{
    protected $entity = Foto::class;
}
