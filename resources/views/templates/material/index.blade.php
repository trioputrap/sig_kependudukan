@extends('layout.app') 

@section('title') 
SIGPENDUK
@endsection

@section('css') 
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" />
<link href="/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
@endsection

@section('menu') 
Kartu Keluarga
@endsection

@section('submenu') 
Tambah Kartu Keluarga
@endsection

@section('content') 

<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-info"><i class="mdi mdi-account-multiple-outline"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-light">23</h3>
                        <h5 class="text-muted m-b-0">User</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-note-multiple-outline"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">2132</h3>
                        <h5 class="text-muted m-b-0">Kartu Keluarga</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-account-multiple-outline"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">152142</h3>
                        <h5 class="text-muted m-b-0">Penduduk</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column 
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-danger"><i class="mdi mdi-note-multiple-outline"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">5687</h3>
                        <h5 class="text-muted m-b-0">Publikasi Invalid</h5></div>
                </div>
            </div>
        </div>
    </div>
    -->
    <!-- Column -->
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-md-12">
        <div class="card">
                <div id="map" style="height: 500px"></div>
        </div>
    </div>
</div>
<!-- Row -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data KK Provinsi</h4>
                <h6 class="card-subtitle">Kartu Keluarga & Penduduk</h6>
                <div class="amp-pxl" style="height: 300px;"></div>
                <div class="text-center">
                    <ul class="list-inline">
                        <li>
                            <h6 class="text-muted  text-info"><i class="fa fa-circle font-10 m-r-10"></i>Penduduk</h6> </li>
                        <li>
                            <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>KK</h6> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Total Publikasi</h3>
                <h6 class="card-subtitle">Perbandingan Publikasi Valid & Invalid</h6>
                <div id="visitor" style="height:260px; width:100%;"></div>
            </div>
            <div>
                <hr class="m-t-0 m-b-0">
            </div>
            <div class="card-body text-center ">
                <ul class="list-inline m-b-0">
                    <li>
                        <h6 class="text-muted text-info"><i class="fa fa-circle font-10 m-r-10 "></i>Valid</h6> </li>
                    <li>
                        <h6 class="text-muted  text-primary"><i class="fa fa-circle font-10 m-r-10"></i>Invalid</h6> </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Row -->
@endsection
@section('js') 
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
    <script>
        $(function () {
            var map = L.map('map').setView([-2.7235830833483856, 118.47242945961344],5);
            var mapPopup = L.popup();
			var markers = L.markerClusterGroup();
            var data_kk = {!! $kk !!}
            L.tileLayer('https://maps.tilehosting.com/styles/streets/{z}/{x}/{y}.png?key=YrAn6SOXelkLFXHv03o2',{
                attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
            }).addTo(map);
            
            data_kk.forEach(function(data){
                var marker = L.marker([data.lat, data.lon]);
                marker.bindPopup(popup(data))
                markers.addLayer(marker);
            });	

            function popup(data){
                return `
                    <h6 class='card-subtitle'>No Kartu Keluarga : </h6>
                    <h5>`+ data.no_kk +`</h5>
                    <h6 class='card-subtitle'>Kepala Keluarga : </h6>
                    <h5>`+ data.nama +`</h5>
                    <h6 class='card-subtitle'>Alamat : </h6>
                    <h5>`+ data.alamat +`</h5>
                    <h6 class='card-subtitle'>Jumlah Anggota : </h6>
                    <h5>`+ data.jml_anggota +`</h5>
                    <a href="#" class='btn btn-primary'>Detail Kartu Keluarga</a>
                `;
            }

    		map.addLayer(markers);	
            // ============================================================== 
            // Sales overview
            // ============================================================== 
            var chart2 = new Chartist.Bar('.amp-pxl', {
                labels: [{!! $bar_chart['prov'] !!}],
                series: [
                    [{!! $bar_chart['jml_penduduk'] !!}],
                    [{!! $bar_chart['jml_kk'] !!}]
                ]
                }, {
                axisX: {
                    // On the x-axis start means top and end means bottom
                    position: 'end',
                    showGrid: false
                },
                axisY: {
                    // On the y-axis start means left and end means right
                    position: 'start'
                },
                low: '0',
                plugins: [
                    Chartist.plugins.tooltip()
                ]
            });
        });
    </script>

@endsection
