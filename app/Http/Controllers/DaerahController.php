<?php

namespace App\Http\Controllers;

use App\Daerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    public function kabupaten($prov_id)
    {
        $kabupatens = Daerah::where('mst_wilayah', $prov_id)->get();
        return $kabupatens;
    }

    public function kecamatan($kab_id)
    {
        $kecamatans = Daerah::where('mst_wilayah', $kab_id)->get();
        return $kecamatans;
    }
    
    public function desa($kec_id)
    {
        $desas = Daerah::where('mst_wilayah', $kec_id)->get();
        return $desas;
    }
}
