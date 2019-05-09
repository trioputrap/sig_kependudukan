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
        return $this->belongsToMany('App\Penduduk', 'anggota_kk');
    }

    public function kepala_keluarga()
    {
        return $this->hasOne('App\AnggotaKK', 'kartu_keluarga_id', 'id')->where('kepala_keluarga', 1);
    }

    public function desa()
    {
        return $this->belongsTo('App\Daerah', 'desa_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\Daerah', 'kecamatan_id', 'id');
    }

    public function kabupaten()
    {
        return $this->belongsTo('App\Daerah', 'kabupaten_id', 'id');
    }
    
    public function provinsi()
    {
        return $this->belongsTo('App\Daerah', 'provinsi_id', 'id');
    }
}
