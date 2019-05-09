<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggotaKK extends Model
{
    public $timestamps = false;
    protected $table = 'anggota_kk';

    protected $fillable = [
        'kartu_keluarga_id', 
        'penduduk_id',
        'tgl_masuk',
        'tgl_keluar',
        'status',
        'kepala_keluarga'
    ];

    public function penduduk()
    {
        return $this->hasOne('App\Penduduk', 'id', 'penduduk_id');
    }

    public function kk()
    {
        return $this->belongsTo('App\KartuKeluarga');
    }
}
