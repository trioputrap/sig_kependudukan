<?php

namespace App\Http\Controllers;

use App\KartuKeluarga;
use App\Daerah;
use App\Penduduk;
use App\AnggotaKK;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kk = KartuKeluarga::all();
        return view('templates.material.kk-view', compact('kk', $kk));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsis = Daerah::where('level', 1)->get();
        return view('templates.material.add-kk', compact('provinsis', $provinsis));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kk = KartuKeluarga::create($request->all());
        $penduduks = array();
        foreach($request->nama as $key => $nama){
            $kepala_keluarga = (!$key)? 1 : 0;
            $data = array(
                "nama" => $nama,
                "no_kitas" => $request->no_kitas[$key],
                "no_paspor" => $request->no_paspor[$key],
                "nik" => $request->nik[$key],
                "nik_ayah" => $request->nik_ayah[$key],
                "nik_ibu" => $request->nik_ibu[$key],
                "jenis_kelamin" => $request->jenis_kelamin[$key],
                "tempat_lahir" => $request->tempat_lahir[$key],
                "agama" => $request->agama[$key],
                "pekerjaan" => $request->pekerjaan[$key],
                "pendidikan" => $request->pendidikan[$key],
                "status_id" => 1
            );
            $penduduk = Penduduk::create($data);

            $data = array(
                "kartu_keluarga_id" => $kk->id,
                "penduduk_id" => $penduduk->id,
                "tgl_masuk" => date("Y-m-d"),
                "status" => 'aktif',
                "kepala_keluarga" => $kepala_keluarga,
            );
            $anggotaKk = AnggotaKK::create($data);

            $penduduks[] = $penduduk;
        }

        return array($kk, $penduduks);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KartuKeluarga $kk)
    {
        $kk->update($request->all());
        $penduduks = array();
        foreach($request->nama as $key => $nama){
            $data = array(
                "nama" => $nama,
                "no_kitas" => $request->no_kitas[$key],
                "no_paspor" => $request->no_paspor[$key],
                "nik" => $request->nik[$key],
                "nik_ayah" => $request->nik_ayah[$key],
                "nik_ibu" => $request->nik_ibu[$key],
                "jenis_kelamin" => $request->jenis_kelamin[$key],
                "tempat_lahir" => $request->tempat_lahir[$key],
                "agama" => $request->agama[$key],
                "pekerjaan" => $request->pekerjaan[$key],
                "pendidikan" => $request->pendidikan[$key],
                "status_id" => 1
            );
            $penduduk = Penduduk::find($request->id_anggota[$key]);
            $penduduk->update($data);
            $penduduks[] = $penduduk;
        }
        return array($kk, $penduduks);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
