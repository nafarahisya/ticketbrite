<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';
    protected $primaryKey = 'id';
    public function acara()
    {
        return $this->belongsTo('App\Acara', 'id', 'id_acara');
    }
    public function member()
    {
        return $this->belongsTo('App\Member', 'id', 'id_member');
    }
}
