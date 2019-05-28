<?php

namespace App\Http\Controllers;

use App\KartuKeluarga;
use App\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //$data['kk'] = KartuKeluarga::all()->toJson();
        
        $data['kk'] = DB::table('kartu_keluarga')
        ->join('anggota_kk', 'kartu_keluarga.id', '=', 'anggota_kk.kartu_keluarga_id')
        ->join('penduduk', 'penduduk.id', '=', 'anggota_kk.penduduk_id')
        ->select(DB::raw('kartu_keluarga.*, penduduk.nama, IFNULL(COUNT(status="aktif"),0) as jml_anggota'))
        ->groupBy('kartu_keluarga.id')
        ->get()->toJson();
                    
        $result = DB::table('kartu_keluarga as kk')
        ->join('anggota_kk', 'kk.id', '=', 'anggota_kk.kartu_keluarga_id')
        ->groupBy('kk.provinsi_id')
        ->join('daerah', 'kk.provinsi_id', '=', 'daerah.id')
        ->select(DB::raw('daerah.nama, IFNULL(COUNT(status="aktif"),0) as jml_penduduk, (SELECT COUNT(id) FROM kartu_keluarga WHERE provinsi_id=kk.provinsi_id) as jml_kk'))
        ->orderBy('jml_penduduk', 'desc')
        ->limit(5)
        ->get();

        $provs = [];
        $jml_penduduk = [];
        $jml_kk = [];
        foreach($result as $key => $val){
            $provs[] = $val->nama;
            $jml_penduduk[] = $val->jml_penduduk;
            $jml_kk[] = $val->jml_kk;
        }

        $data['kk'] = KartuKeluarga::all();
        $data['penduduk'] = Penduduk::all();

        $data['bar_chart']['prov'] = '"' . implode('","', $provs) . '"';
        $data['bar_chart']['jml_penduduk'] = implode(',', $jml_penduduk);
        $data['bar_chart']['jml_kk'] = implode(',', $jml_kk);

        return view('templates.material.index', $data);
    }
}
