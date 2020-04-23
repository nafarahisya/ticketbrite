<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    protected $table = 'acara';
    protected $primaryKey = 'id';
    protected $appends = [
        'sisa_kuota'
    ];
    public function getSisaKuotaAttribute()
    {
        return $this->maksimal - count($this->pesanan);
    }
    public function pesanan()
    {
        return $this->hasMany('App\Pesan', 'id_acara', 'id');
    }
    public function panitia()
    {
        return $this->belongsTo('App\Panitia', 'id', 'id_panitia');
    }
    public function komentar()
    {
        return $this->hasMany('App\Komentar', 'id_acara', 'id');
    }
}
