<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    public $timestamps = false;
    protected $table = 'provinsi';

    protected $fillable = [
        'nama',
    ];

    public function kk()
    {
        return $this->hasMany('App\KartuKeluarga');
    }
    
    public function provinsi()
    {
        return $this->belongsTo('App\Provinsi');
    }
}
