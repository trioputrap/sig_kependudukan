<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    public $timestamps = false;
    protected $table = 'penduduk';

    protected $fillable = [
        'nama', 
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'kartu_keluarga_id',
        'pekerjaan',
        'pendidikan',
        'no_kitas',
        'no_paspor',
        'status_id',
    ];

    public function kk()
    {
        return $this->belongsTo('App\KartuKeluarga');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function foto()
    {
        return $this->hasMany('App\Foto');
    }
}
