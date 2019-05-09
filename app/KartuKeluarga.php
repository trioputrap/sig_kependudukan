<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    public $timestamps = false;
    protected $table = 'kartu_keluarga';

    protected $fillable = [
        'no_kk',
        'alamat',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'rt',
        'rw',
        'lat',
        'lon',
        'valid'
    ];

    public function anggota()
    {
        return $this->hasMany('App\Penduduk');
    }

    public function desa()
    {
        return $this->belongsTo('App\Desa');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan');
    }

    public function kabupaten()
    {
        return $this->belongsTo('App\Kabupaten');
    }
    
    public function provinsi()
    {
        return $this->belongsTo('App\Provinsi');
    }
}
