<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServidorTemporario extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'servidor_temporario';
    protected $fillable = ['pes_id', 'st_data_admissao', 'st_data_demissao'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }
}
