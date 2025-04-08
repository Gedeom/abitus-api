<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;

class Pessoa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'pes_id';
    protected $table  = 'pessoa';
    protected $fillable = ['pes_nome', 'pes_data_nascimento', 'pes_sexo', 'pes_mae', 'pes_pai'];

    public function foto()
    {
        return $this->hasOne(FotoPessoa::class, 'pes_id', 'pes_id');
    }

    public function enderecos()
    {
        return $this->hasMany(PessoaEndereco::class, 'pes_id', 'pes_id');
    }

    public function servidorTemporario()
    {
        return $this->hasOne(ServidorTemporario::class, 'pes_id', 'pes_id');
    }

    public function servidorEfetivo()
    {
        return $this->hasOne(ServidorEfetivo::class, 'pes_id', 'pes_id');
    }

    public function lotacao()
    {
        return $this->hasOne(Lotacao::class, 'pes_id', 'pes_id');
    }

    public function idade()
    {
        $date = new DateTime($this->pes_data_nascimento);
        $now = new DateTime(date('Y-m-d'));
        $interval = $date->diff($now);
        return $interval->y;
    }
}
