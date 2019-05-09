<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    public $timestamps = false;
    protected $table = 'daerah';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public function kk_desa()
    {
        return $this->hasMany('App\KartuKeluarga', 'id', 'desa_id');
    }

    public function kk_kecamatan()
    {
        return $this->hasMany('App\KartuKeluarga', 'id', 'kecamatan_id');
    }

    public function kk_kabupaten()
    {
        return $this->hasMany('App\KartuKeluarga', 'id', 'kabupaten_id');
    }
    
    public function kk_provinsi()
    {
        return $this->hasMany('App\KartuKeluarga', 'id', 'provinsi_id');
    }
}
