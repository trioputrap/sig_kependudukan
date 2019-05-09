<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    public $timestamps = false;
    protected $table = 'kecamatan';
    
    protected $fillable = [
        'nama', 'kabupaten_id',
    ];

    public function kk()
    {
        return $this->hasMany('App\KartuKeluarga');
    }
    
    public function kabupaten()
    {
        return $this->belongsTo('App\Kabupaten');
    }
}
