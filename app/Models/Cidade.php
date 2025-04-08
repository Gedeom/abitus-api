<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cidade extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'cid_id';
    protected $fillable = ['cid_nome', 'cid_uf'];
    protected $table  = 'cidade';

    /**
     * Override the default primary key for the model.
     *
     * @return string
     */
    public function getKeyName()
    {
        return 'cid_id';
    }
}
