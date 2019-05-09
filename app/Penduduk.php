<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    public $timestamps = false;
    protected $table = 'penduduk';

    protected $fillable = [
        'nama', 
        'no_kitas',
        'no_paspor',
        'nik',
        'nik_ayah',
        'nik_ibu',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pekerjaan',
        'pendidikan',
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
