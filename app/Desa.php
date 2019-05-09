<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    public $timestamps = false;
    protected $table = 'desa';

    protected $fillable = [
        'nama', 'kecamatan_id',
    ];

    public function kk()
    {
        return $this->hasMany('App\KartuKeluarga');
    }
    
    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan');
    }
}
