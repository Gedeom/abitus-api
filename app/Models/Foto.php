<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;

class Foto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table  = 'foto_pessoa';
    protected $primaryKey = 'fp_id';

    protected $fillable = ['fp_hash', 'fp_data', 'fp_bucket', 'pes_id'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }
}
