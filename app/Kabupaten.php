<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    public $timestamps = false;
    protected $table = 'kabupaten';

    protected $fillable = [
        'nama', 'provinsi_id',
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
