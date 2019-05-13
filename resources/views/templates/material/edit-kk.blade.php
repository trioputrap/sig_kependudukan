@extends('layout.app') 

@section('title') 
SIGPENDUK
@endsection

@section('css') 
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" />
<link href="/assets/plugins/wizard/steps.css" rel="stylesheet">
<link href="/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
@endsection

@section('menu') 
Kartu Keluarga
@endsection

@section('submenu') 
Edit Kartu Keluarga
@endsection

@section('content') 

<!-- vertical wizard -->
<div id="validation" class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body wizard-content ">
                <h4 class="card-title">Edit Kartu Keluarga</h4>
                <h6 class="card-subtitle">Form Edit Kartu Keluarga</h6>
                <form id="form_kk" class="validation-wizard vertical wizard-circle">
                    <!-- Step 1 -->
                    @csrf
                    <input value="{{$kk->id}}" name="id" type="hidden" class="form-control" id="id"> 
                    <h6>Kartu Keluarga</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kk">Nomor KK :</label>
                                    <input value="{{$kk->no_kk}}" name="no_kk" type="text" class="form-control required" id="no_kk"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat :</label>
                                    <input value="{{$kk->alamat}}" name="alamat" type="text" class="form-control required" id="alamat"> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slc_prov">Provinsi :</label>
                                    <select name="provinsi_id" id="slc_prov" class="form-control custom-select required">
                                        <option value="">-PILIH PROVINSI-</option>
                                        @foreach($provinsis as $provinsi)
                                        <option value="{{$provinsi->id}}" {{($provinsi->id==$kk->provinsi_id)?'selected':''}}>{{$provinsi->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slc_kab">Kabupaten :</label>    
                                    <select name="kabupaten_id" id="slc_kab" class="form-control custom-select required">
                                        <option value="">-PILIH PROVINSI TERLEBIH DAHULU-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slc_kec">Kecamatan :</label>    
                                    <select name="kecamatan_id" id="slc_kec" class="form-control custom-select required">
                                        <option value="">-PILIH KABUPATEN TERLEBIH DAHULU-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date1">Desa :</label>
                                    <select name="desa_id" id="slc_desa" class="form-control custom-select required">
                                        <option value="">-PILIH KECAMATAN TERLEBIH DAHULU-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date1">RT :</label>
                                    <input value="{{$kk->rt}}" name="rt" type="text" class="form-control required"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date1">RW :</label>
                                    <input value="{{$kk->rw}}" name="rw" type="text" class="form-control required"> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="map">Lokasi :</label>
                                    <div id="map" style="height: 300px"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date1">Latitude :</label>
                                    <input id="lat" value="{{$kk->lat}}" name="lat" type="text" class="form-control required"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date1">Longitude :</label>
                                    <input id="lon" value="{{$kk->lon}}" name="lon" type="text" class="form-control required"> 
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h6>Anggota<br>Kartu Keluarga</h6>
                    <section>
                        <input value="{{$kk->anggota[0]->id}}" name="id_anggota[]" type="hidden" class="id_anggota form-control" id="id_anggota"> 
                        <h4>Kepala Keluarga</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama :</label>
                                    <input value="{{$kk->anggota[0]->nama}}" name="nama[]" type="text" class="form-control required" id="nama"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik">NIK :</label>
                                    <input value="{{$kk->anggota[0]->NIK}}" name="nik[]" type="text" class="form-control required" id="nik">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik_ayah">NIK Ayah :</label>
                                    <input value="{{$kk->anggota[0]->NIK_ayah}}" name="nik_ayah[]" type="text" class="form-control required" id="nik_ayah">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik_ibu">NIK Ibu :</label>
                                    <input value="{{$kk->anggota[0]->NIK_ibu}}" name="nik_ibu[]" type="text" class="form-control required" id="nik_ibu">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kitas">No Kitas :</label>
                                    <input value="{{$kk->anggota[0]->no_kitas}}" name="no_kitas[]" type="text" class="form-control required" id="no_kitas">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_paspor">No Paspor :</label>
                                    <input value="{{$kk->anggota[0]->no_paspor}}" name="no_paspor[]" type="text" class="form-control required" id="no_paspor">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin :</label>
                                    <select name="jenis_kelamin[]" id="jenis_kelamin" class="form-control custom-select required">
                                        <option value="">-PILIH JENIS KELAMIN-</option>
                                        <option value="laki-laki" {{($kk->anggota[0]->jenis_kelamin=="LAKI-LAKI")?'selected':''}}>LAKI-LAKI</option>
                                        <option value="perempuan" {{($kk->anggota[0]->jenis_kelamin=="PEREMPUAN")?'selected':''}}>PEREMPUAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir :</label>
                                    <input value="{{$kk->anggota[0]->tempat_lahir}}" name="tempat_lahir[]" type="text" class="form-control required" id="tempat_lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir :</label>
                                    <input value="{{$kk->anggota[0]->tanggal_lahir}}" name="tanggal_lahir[]" type="date" class="form-control required" id="tanggal_lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agama">Agama :</label> 
                                    <select name="agama[]" id="agama" class="form-control custom-select required">
                                        <option value="">-PILIH AGAMA-</option>
                                        <option value="hindu" {{($kk->anggota[0]->agama=="HINDU")?'selected':''}}>Hindu</option>
                                        <option value="islam" {{($kk->anggota[0]->agama=="ISLAM")?'selected':''}}>Islam</option>
                                        <option value="protestan" {{($kk->anggota[0]->agama=="PROTESTAN")?'selected':''}}>Protestan</option>
                                        <option value="kong hu cu" {{($kk->anggota[0]->agama=="KONG HU CU")?'selected':''}}>Kong Hu Cu</option>
                                        <option value="katolik" {{($kk->anggota[0]->agama=="KATOLIK")?'selected':''}}>Katolik</option>
                                        <option value="budha" {{($kk->anggota[0]->agama=="BUDHA")?'selected':''}}>Budha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan :</label>
                                    <select name="pekerjaan[]" id="pekerjaan" class="form-control custom-select required">
                                        <option value="">-PILIH PEKERJAAN-</option>
                                        <option value="Belum/Tidak Bekerja" {{($kk->anggota[0]->pekerjaan=="hindu")?'selected':''}}>Belum/Tidak Bekerja</option>
                                        <option value="Pelajar/Mahasiswa" {{($kk->anggota[0]->pekerjaan=="Pelajar/Mahasiswa")?'selected':''}}>Pelajar/Mahasiswa</option>
                                        <option value="Pensiunan" {{($kk->anggota[0]->pekerjaan=="Pensiunan")?'selected':''}}>Pensiunan</option>
                                        <option value="Pegawai Negeri Sipil" {{($kk->anggota[0]->pekerjaan=="Pegawai Negeri Sipil")?'selected':''}}>Pegawai Negeri Sipil</option>
                                        <option value="Tentara Nasional Indonesia" {{($kk->anggota[0]->pekerjaan=="Tentara Nasional Indonesia")?'selected':''}}>Tentara Nasional Indonesia</option>
                                        <option value="Kepolisian RI" {{($kk->anggota[0]->pekerjaan=="Kepolisian RI")?'selected':''}}>Kepolisian RI</option>
                                        <option value="Perdagangan" {{($kk->anggota[0]->pekerjaan=="Perdagangan")?'selected':''}}>Perdagangan</option>
                                        <option value="Petani/Pekebun" {{($kk->anggota[0]->pekerjaan=="Petani/Pekebun")?'selected':''}}>Petani/Pekebun</option>
                                        <option value="Peternak" {{($kk->anggota[0]->pekerjaan=="Peternak")?'selected':''}}>Peternak</option>
                                        <option value="Nelayan/Perikanan" {{($kk->anggota[0]->pekerjaan=="Nelayan/Perikanan")?'selected':''}}>Nelayan/Perikanan</option>
                                        <option value="Industri" {{($kk->anggota[0]->pekerjaan=="Industri")?'selected':''}}>Industri</option>
                                        <option value="Konstruksi" {{($kk->anggota[0]->pekerjaan=="Konstruksi")?'selected':''}}>Konstruksi</option>
                                        <option value="Transportasi" {{($kk->anggota[0]->pekerjaan=="Transportasi")?'selected':''}}>Transportasi</option>
                                        <option value="Karyawan Swasta" {{($kk->anggota[0]->pekerjaan=="Karyawan Swasta")?'selected':''}}>Karyawan Swasta</option>
                                        <option value="Karyawan BUMN" {{($kk->anggota[0]->pekerjaan=="Karyawan BUMN")?'selected':''}}>Karyawan BUMN</option>
                                        <option value="Karyawan BUMD" {{($kk->anggota[0]->pekerjaan=="Karyawan BUMD")?'selected':''}}>Karyawan BUMD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pendidikan">Pendidikan :</label>
                                    <select name="pendidikan[]" id="pendidikan" class="form-control custom-select required">
                                        <option value="">-PILIH PENDIDIKAN-</option>
                                        <option value="Tidak/Belum Sekolah" {{($kk->anggota[0]->pendidikan=="Tidak/Belum Sekolah")?'selected':''}}>Tidak/Belum Sekolah</option>
                                        <option value="Tidak Tamat SD/Sederajat" {{($kk->anggota[0]->pendidikan=="Tidak Tamat SD/Sederajat")?'selected':''}}>Tidak Tamat SD/Sederajat</option>
                                        <option value="Tamat SD/Sederajat" {{($kk->anggota[0]->pendidikan=="Tamat SD/Sederajat")?'selected':''}}>Tamat SD/Sederajat</option>
                                        <option value="SLTP/Sederajat" {{($kk->anggota[0]->pendidikan=="SLTP/Sederajat")?'selected':''}}>SLTP/Sederajat</option>
                                        <option value="SLTA/Sederjat" {{($kk->anggota[0]->pendidikan=="SLTA/Sederjat")?'selected':''}}>SLTA/Sederjat</option>
                                        <option value="Transportasi" {{($kk->anggota[0]->pendidikan=="Transportasi")?'selected':''}}>Transportasi</option>
                                        <option value="Diploma I/II" {{($kk->anggota[0]->pendidikan=="Diploma I/II")?'selected':''}}>Diploma I/II</option>
                                        <option value="Akademi/Diploma III/S. Muda" {{($kk->anggota[0]->pendidikan=="Akademi/Diploma III/S. Muda")?'selected':''}}>Akademi/Diploma III/S. Muda</option>
                                        <option value="DilpomaIV/Strata I" {{($kk->anggota[0]->pendidikan=="DilpomaIV/Strata I")?'selected':''}}>DilpomaIV/Strata I</option>
                                        <option value="Strata II" {{($kk->anggota[0]->pendidikan=="Strata II")?'selected':''}}>Strata II</option>
                                        <option value="Strata III" {{($kk->anggota[0]->pendidikan=="Strata III")?'selected':''}}>Strata III</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <section id="section_anggota">
                            @foreach($kk->anggota as $key => $anggota)
                            @if(!$key) 
                                @continue
                            @endif
                            <br>
                            <input value="{{$anggota->id}}" name="id_anggota[]" type="hidden" class="id_anggota form-control" id="id_anggota"> 
                            <h4>Anggota Keluarga {{$key+1}}</h4>
                            <button type="button" class="btn btn-danger">Hapus Anggota</button>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama :</label>
                                        <input value="{{$anggota->nama}}" name="nama[]" type="text" class="form-control required" id="nama"> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK :</label>
                                        <input value="{{$anggota->NIK}}" name="nik[]" type="text" class="form-control required" id="nik">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik_ayah">NIK Ayah :</label>
                                        <input value="{{$anggota->NIK_ayah}}" name="nik_ayah[]" type="text" class="form-control required" id="nik_ayah">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik_ibu">NIK Ibu :</label>
                                        <input value="{{$anggota->NIK_ibu}}" name="nik_ibu[]" type="text" class="form-control required" id="nik_ibu">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_kitas">No Kitas :</label>
                                        <input value="{{$anggota->no_kitas}}" name="no_kitas[]" type="text" class="form-control required" id="no_kitas">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_paspor">No Paspor :</label>
                                        <input value="{{$anggota->no_paspor}}" name="no_paspor[]" type="text" class="form-control required" id="no_paspor">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin :</label>
                                        <select name="jenis_kelamin[]" id="jenis_kelamin" class="form-control custom-select required">
                                            <option value="">-PILIH JENIS KELAMIN-</option>
                                            <option value="laki-laki" {{($anggota->jenis_kelamin=="LAKI-LAKI")?'selected':''}}>LAKI-LAKI</option>
                                            <option value="perempuan" {{($anggota->jenis_kelamin=="PEREMPUAN")?'selected':''}}>PEREMPUAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir :</label>
                                        <input value="{{$anggota->tempat_lahir}}" name="tempat_lahir[]" type="text" class="form-control required" id="tempat_lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir :</label>
                                        <input value="{{$anggota->tanggal_lahir}}" name="tanggal_lahir[]" type="date" class="form-control required" id="tanggal_lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agama">Agama :</label> 
                                        <select name="agama[]" id="agama" class="form-control custom-select required">
                                            <option value="">-PILIH AGAMA-</option>
                                            <option value="hindu" {{($anggota->agama=="HINDU")?'selected':''}}>Hindu</option>
                                            <option value="islam" {{($anggota->agama=="ISLAM")?'selected':''}}>Islam</option>
                                            <option value="protestan" {{($anggota->agama=="PROTESTAN")?'selected':''}}>Protestan</option>
                                            <option value="kong hu cu" {{($anggota->agama=="KONG HU CU")?'selected':''}}>Kong Hu Cu</option>
                                            <option value="katolik" {{($anggota->agama=="KATOLIK")?'selected':''}}>Katolik</option>
                                            <option value="budha" {{($anggota->agama=="BUDHA")?'selected':''}}>Budha</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pekerjaan">Pekerjaan :</label>
                                        <select name="pekerjaan[]" id="pekerjaan" class="form-control custom-select required">
                                            <option value="">-PILIH PEKERJAAN-</option>
                                            <option value="Belum/Tidak Bekerja" {{($anggota->pekerjaan=="hindu")?'selected':''}}>Belum/Tidak Bekerja</option>
                                            <option value="Pelajar/Mahasiswa" {{($anggota->pekerjaan=="Pelajar/Mahasiswa")?'selected':''}}>Pelajar/Mahasiswa</option>
                                            <option value="Pensiunan" {{($anggota->pekerjaan=="Pensiunan")?'selected':''}}>Pensiunan</option>
                                            <option value="Pegawai Negeri Sipil" {{($anggota->pekerjaan=="Pegawai Negeri Sipil")?'selected':''}}>Pegawai Negeri Sipil</option>
                                            <option value="Tentara Nasional Indonesia" {{($anggota->pekerjaan=="Tentara Nasional Indonesia")?'selected':''}}>Tentara Nasional Indonesia</option>
                                            <option value="Kepolisian RI" {{($anggota->pekerjaan=="Kepolisian RI")?'selected':''}}>Kepolisian RI</option>
                                            <option value="Perdagangan" {{($anggota->pekerjaan=="Perdagangan")?'selected':''}}>Perdagangan</option>
                                            <option value="Petani/Pekebun" {{($anggota->pekerjaan=="Petani/Pekebun")?'selected':''}}>Petani/Pekebun</option>
                                            <option value="Peternak" {{($anggota->pekerjaan=="Peternak")?'selected':''}}>Peternak</option>
                                            <option value="Nelayan/Perikanan" {{($anggota->pekerjaan=="Nelayan/Perikanan")?'selected':''}}>Nelayan/Perikanan</option>
                                            <option value="Industri" {{($anggota->pekerjaan=="Industri")?'selected':''}}>Industri</option>
                                            <option value="Konstruksi" {{($anggota->pekerjaan=="Konstruksi")?'selected':''}}>Konstruksi</option>
                                            <option value="Transportasi" {{($anggota->pekerjaan=="Transportasi")?'selected':''}}>Transportasi</option>
                                            <option value="Karyawan Swasta" {{($anggota->pekerjaan=="Karyawan Swasta")?'selected':''}}>Karyawan Swasta</option>
                                            <option value="Karyawan BUMN" {{($anggota->pekerjaan=="Karyawan BUMN")?'selected':''}}>Karyawan BUMN</option>
                                            <option value="Karyawan BUMD" {{($anggota->pekerjaan=="Karyawan BUMD")?'selected':''}}>Karyawan BUMD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pendidikan">Pendidikan :</label>
                                        <select name="pendidikan[]" id="pendidikan" class="form-control custom-select required">
                                            <option value="">-PILIH PENDIDIKAN-</option>
                                            <option value="Tidak/Belum Sekolah" {{($anggota->pendidikan=="Tidak/Belum Sekolah")?'selected':''}}>Tidak/Belum Sekolah</option>
                                            <option value="Tidak Tamat SD/Sederajat" {{($anggota->pendidikan=="Tidak Tamat SD/Sederajat")?'selected':''}}>Tidak Tamat SD/Sederajat</option>
                                            <option value="Tamat SD/Sederajat" {{($anggota->pendidikan=="Tamat SD/Sederajat")?'selected':''}}>Tamat SD/Sederajat</option>
                                            <option value="SLTP/Sederajat" {{($anggota->pendidikan=="SLTP/Sederajat")?'selected':''}}>SLTP/Sederajat</option>
                                            <option value="SLTA/Sederjat" {{($anggota->pendidikan=="SLTA/Sederjat")?'selected':''}}>SLTA/Sederjat</option>
                                            <option value="Transportasi" {{($anggota->pendidikan=="Transportasi")?'selected':''}}>Transportasi</option>
                                            <option value="Diploma I/II" {{($anggota->pendidikan=="Diploma I/II")?'selected':''}}>Diploma I/II</option>
                                            <option value="Akademi/Diploma III/S. Muda" {{($anggota->pendidikan=="Akademi/Diploma III/S. Muda")?'selected':''}}>Akademi/Diploma III/S. Muda</option>
                                            <option value="DilpomaIV/Strata I" {{($anggota->pendidikan=="DilpomaIV/Strata I")?'selected':''}}>DilpomaIV/Strata I</option>
                                            <option value="Strata II" {{($anggota->pendidikan=="Strata II")?'selected':''}}>Strata II</option>
                                            <option value="Strata III" {{($anggota->pendidikan=="Strata III")?'selected':''}}>Strata III</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </section>
                        <button type="button" id="btn_add" class="btn btn-success">Tambah Anggota</button>
                        <!--<button type="submit" id="btn_add" class="btn btn-success">Submit</button>-->
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js') 
<script src="/assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
<script src="/assets/plugins/wizard/jquery.steps.min.js"></script>
<script src="/assets/plugins/wizard/jquery.validate.min.js"></script>
<script src="/assets/plugins/wizard/steps.js"></script>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
<script>
    
        var map = L.map('map').setView([-8.395636, 115.175905],10);
        var mapPopup = L.popup();
        var marker = L.marker([{{$kk->lat}}, {{$kk->lon}}]).addTo(map);
        
        L.tileLayer('https://maps.tilehosting.com/styles/streets/{z}/{x}/{y}.png?key=YrAn6SOXelkLFXHv03o2',{
            attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
        }).addTo(map);
        
        map.on('click',function(e){
            if(marker!=null){
                map.removeLayer(marker);
            }
            marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
            $("#lat").val(e.latlng.lat)
            $("#lon").val(e.latlng.lng)
        });

        function ajax_daerah(daerah, id, select_element, master){
            $.ajax({
                url: "http://sigpenduk.herokuapp.com/api/"+ id +"/"+ daerah,
                type: "GET",
                crossDomain: true,
                dataType: "json",                
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    $(select_element).html('<option value="">-PILIH '+daerah.toUpperCase()+'-</option>');
                    $(select_element).prop('disabled', false);
                    response.forEach(function(item){
                        $(select_element).append('<option value="'+item.id+'">'+item.nama+'</option>')
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    $(select_element).html('<option value="">-PILIH '+master.toUpperCase()+' TERLEBIH DAHULU-</option>');
                    $(select_element).prop('disabled', true);
                                                        
                }
            });
        }
        $("#slc_prov").change(function(){
            ajax_daerah('kabupaten', $(this).val(), "#slc_kab", 'provinsi');
        });
        $("#slc_kab").change(function(){
            ajax_daerah('kecamatan', $(this).val(), "#slc_kec", 'kabupaten');
        });
        $("#slc_kec").change(function(){
            ajax_daerah('desa', $(this).val(), "#slc_desa", 'kecamatan');
        });
        var i = 0;
        $("#btn_add").click(function(){
            i++;
            $("#section_anggota").append(`
            <div>
                <br>
                <input name="id_anggota[]" type="hidden" class="id_anggota form-control" id="id_anggota`+i+`"> 
                <h4 class="title-anggota">Anggota Keluarga `+i+`</h4>
                <button type="button" class="btn btn-danger">Hapus Anggota</button>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama`+i+`">Nama :</label>
                            <input name="nama[]" type="text" class="form-control" id="nama`+i+`"> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik`+i+`">NIK :</label>
                            <input name="nik[]" type="text" class="form-control" id="nik`+i+`">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik_ayah`+i+`">NIK Ayah :</label>
                            <input name="nik_ayah[]" type="text" class="form-control" id="nik_ayah`+i+`">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik_ibu`+i+`">NIK Ibu :</label>
                            <input name="nik_ibu[]" type="text" class="form-control" id="nik_ibu`+i+`">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_kitas`+i+`">No Kitas :</label>
                            <input name="no_kitas[]" type="text" class="form-control required" id="no_kitas`+i+`">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_paspor`+i+`">No Paspor :</label>
                            <input name="no_paspor[]" type="text" class="form-control required" id="no_paspor`+i+`">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin`+i+`">Jenis Kelamin :</label>
                            <select name="jenis_kelamin[]" id="jenis_kelamin`+i+`" class="form-control custom-select required">
                                <option value="">-PILIH JENIS KELAMIN-</option>
                                <option value="laki-laki">LAKI-LAKI</option>
                                <option value="perempuan">PEREMPUAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_lahir`+i+`">Tempat Lahir :</label>
                            <input name="tempat_lahir[]" type="text" class="form-control" id="tempat_lahir`+i+`">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_lahir`+i+`">Tanggal Lahir :</label>
                            <input name="tanggal_lahir[]" type="date" class="form-control" id="tanggal_lahir`+i+`">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="agama`+i+`">Agama :</label> 
                            <select name="agama[]" id="agama`+i+`" class="form-control custom-select" required>
                                <option value="">-PILIH AGAMA-</option>
                                <option value="hindu">Hindu</option>
                                <option value="islam">Islam</option>
                                <option value="protestan">Protestan</option>
                                <option value="kong hu cu">Kong Hu Cu</option>
                                <option value="katolik">Katolik</option>
                                <option value="budha">Budha</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pekerjaan`+i+`">Pekerjaan :</label>
                            <select name="pekerjaan[]" id="pekerjaan`+i+`" class="form-control custom-select" required>
                                <option value="">-PILIH PEKERJAAN-</option>
                                <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                                <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                <option value="Pensiunan">Pensiunan</option>
                                <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                <option value="Tentara Nasional Indonesia">Tentara Nasional Indonesia</option>
                                <option value="Kepolisian RI">Kepolisian RI</option>
                                <option value="Perdagangan">Perdagangan</option>
                                <option value="Petani/Pekebun">Petani/Pekebun</option>
                                <option value="Peternak">Peternak</option>
                                <option value="Nelayan/Perikanan">Nelayan/Perikanan</option>
                                <option value="Industri">Industri</option>
                                <option value="Konstruksi">Konstruksi</option>
                                <option value="Transportasi">Transportasi</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="Karyawan BUMN">Karyawan BUMN</option>
                                <option value="Karyawan BUMD">Karyawan BUMD</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pendidikan`+i+`">Pendidikan :</label>
                            <select name="pendidikan[]" id="pendidikan`+i+`" class="form-control custom-select" required>
                                <option value="">-PILIH PENDIDIKAN-</option>
                                <option value="Tidak/Belum Sekolah">Tidak/Belum Sekolah</option>
                                <option value="Tidak Tamat SD/Sederajat">Tidak Tamat SD/Sederajat</option>
                                <option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
                                <option value="SLTP/Sederajat">SLTP/Sederajat</option>
                                <option value="SLTA/Sederjat">SLTA/Sederjat</option>
                                <option value="Transportasi">Transportasi</option>
                                <option value="Diploma I/II">Diploma I/II</option>
                                <option value="Akademi/Diploma III/S. Muda">Akademi/Diploma III/S. Muda</option>
                                <option value="DilpomaIV/Strata I">DilpomaIV/Strata I</option>
                                <option value="Strata II">Strata II</option>
                                <option value="Strata III">Strata III</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            `);

            $(".btn-danger").click(function(){
                var thus =  $(this);
                swal({   
                    title: "Hapus Anggota Kartu Keluarga?",     
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "YA",   
                    closeOnConfirm: false 
                }, function(){   
                    thus.parent().remove();        
                    $( ".title-anggota" ).each(function( index ) {
                        $( this ).text("Anggota Keluarga "+ (index+1));
                    });
                    swal("Terhapus!", "Berhasil menghapus anggota kartu keluarga", "success"); 
                });
            });
        });        

        
    </script>
@endsection