<?php

namespace App\Http\Controllers;

use App\KartuKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //$data['kk'] = KartuKeluarga::all()->toJson();
        
        $data['kk'] = $query = DB::table('kartu_keluarga')
                        ->join('anggota_kk', 'kartu_keluarga.id', '=', 'anggota_kk.kartu_keluarga_id')
                        ->join('penduduk', 'penduduk.id', '=', 'anggota_kk.penduduk_id')
                        ->select(DB::raw('kartu_keluarga.*, penduduk.nama, IFNULL(COUNT(status="aktif"),0) as jml_anggota'))
                        ->groupBy('kartu_keluarga.id')
                        ->get()->toJson();
        return view('templates.material.index', $data);
    }
}
