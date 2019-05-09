<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    public $timestamps = false;
    protected $table = 'foto';
    protected $fillable = [
        'penduduk_id', 
        'link_foto',
        'link_sidik_jari',
    ];
}
