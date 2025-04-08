<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
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
