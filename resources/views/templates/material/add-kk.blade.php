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
Tambah Kartu Keluarga
@endsection

@section('content') 

<div id="validation" class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body wizard-content ">
                <h4 class="card-title">Tambah Kartu Keluarga</h4>
                <h6 class="card-subtitle">Form Tambah Kartu Keluarga</h6>
                <form id="form_kk" class="validation-wizard vertical wizard-circle">
                    <!-- Step 1 -->
                    @csrf
                    <input name="id" type="hidden" class="form-control" id="id"> 
                    <h6>Kartu Keluarga</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kk">Nomor KK :</label>
                                    <input name="no_kk" type="text" class="form-control required" id="no_kk"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat :</label>
                                    <input name="alamat" type="text" class="form-control required" id="alamat"> 
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
                                        <option value="{{$provinsi->id}}">{{$provinsi->nama}}</option>
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
                                    <label for="slc_desa">Desa :</label>
                                    <select name="desa_id" id="slc_desa" class="form-control custom-select required">
                                        <option value="">-PILIH KECAMATAN TERLEBIH DAHULU-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date1">RT :</label>
                                    <input name="rt" type="text" class="form-control required"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date1">RW :</label>
                                    <input name="rw" type="text" class="form-control required"> 
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
                                    <label for="lat">Latitude :</label>
                                    <input id="lat" name="lat" type="number" class="form-control required" readonly="readonly" > 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lon">Longitude :</label>
                                    <input id="lon" name="lon" type="number" class="form-control required" readonly="readonly" > 
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h6>Anggota<br>Kartu Keluarga</h6>
                    <section>
                        <input name="id_anggota[]" type="hidden" class="id_anggota form-control" id="id_anggota"> 
                        <h4>Kepala Keluarga</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama :</label>
                                    <input name="nama[]" type="text" class="form-control required" id="nama"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik">NIK :</label>
                                    <input name="nik[]" type="text" class="form-control required" id="nik">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik_ayah">NIK Ayah :</label>
                                    <input name="nik_ayah[]" type="text" class="form-control required" id="nik_ayah">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik_ibu">NIK Ibu :</label>
                                    <input name="nik_ibu[]" type="text" class="form-control required" id="nik_ibu">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kitas">No Kitas :</label>
                                    <input name="no_kitas[]" type="text" class="form-control required" id="no_kitas">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_paspor">No Paspor :</label>
                                    <input name="no_paspor[]" type="text" class="form-control required" id="no_paspor">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin :</label>
                                    <select name="jenis_kelamin[]" id="jenis_kelamin" class="form-control custom-select required">
                                        <option value="">-PILIH JENIS KELAMIN-</option>
                                        <option value="laki-laki">LAKI-LAKI</option>
                                        <option value="perempuan">PEREMPUAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir :</label>
                                    <input name="tempat_lahir[]" type="text" class="form-control required" id="tempat_lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir :</label>
                                    <input name="tanggal_lahir[]" type="date" class="form-control required" id="tanggal_lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agama">Agama :</label> 
                                    <select name="agama[]" id="agama" class="form-control custom-select required">
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
                                    <label for="pekerjaan">Pekerjaan :</label>
                                    <select name="pekerjaan[]" id="pekerjaan" class="form-control custom-select required">
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
                                    <label for="pendidikan">Pendidikan :</label>
                                    <select name="pendidikan[]" id="pendidikan" class="form-control custom-select required">
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
                        <section id="section_anggota"></section>
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
    $(document).ready(function() {
        var map = L.map('map').setView([-8.395636, 115.175905],10);
        var mapPopup = L.popup();
        var marker = null;

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
            $(select_element).html('<option value="">-SEDANG MEMUAT DATA '+daerah.toUpperCase()+'-</option>');
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
                    response.forEach(function(item){
                        $(select_element).append('<option value="'+item.id+'">'+item.nama+'</option>')
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    $(select_element).html('<option value="">-PILIH '+master.toUpperCase()+' TERLEBIH DAHULU-</option>');
                                                        
                }
            });
        }

        $("#slc_prov").change(function(){
            ajax_daerah('kabupaten', $(this).val(), "#slc_kab", 'provinsi');
            $("#slc_kec").html('<option value="">-PILIH KABUPATEN TERLEBIH DAHULU-</option>');
            $("#slc_desa").html('<option value="">-PILIH KECAMATAN TERLEBIH DAHULU-</option>');
            $("#slc_desa").html('<option value="">-PILIH KECAMATAN TERLEBIH DAHULU-</option>');
        });
        $("#slc_kab").change(function(){
            ajax_daerah('kecamatan', $(this).val(), "#slc_kec", 'kabupaten');
            $("#slc_desa").html('<option value="">-PILIH KECAMATAN TERLEBIH DAHULU-</option>');
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

    });
</script>
@endsection
    
