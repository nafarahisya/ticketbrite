<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id';
    public function acara()
    {
        return $this->belongsTo('App\Acara', 'id', 'id_acara');
    }
}
