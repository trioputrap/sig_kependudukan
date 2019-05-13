@extends('layout.app') 

@section('title') 
SIGPENDUK
@endsection

@section('css') 
<link href="/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
@endsection

@section('menu') 
Penduduk
@endsection

@section('submenu') 
Lihat Penduduk
@endsection

@section('content') 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-20">
                    <table id="myTable" class="table stylish-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No KK</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penduduks as $key => $penduduk)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$penduduk->anggota_aktif->kk->no_kk}}</td>
                                <td>{{$penduduk->NIK}}</td>
                                <td>{{$penduduk->nama}}</td>
                                <td>{{$penduduk->jenis_kelamin}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js') 
<!--Custom JavaScript -->
<script src="/template/js/custom.min.js"></script>
<script src="/assets/plugins/moment/min/moment.min.js"></script>
<script src="/assets/plugins/wizard/jquery.steps.min.js"></script>
<script src="/assets/plugins/wizard/jquery.validate.min.js"></script>
<!-- Sweet-Alert  -->
<script src="/assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/assets/plugins/wizard/steps.js"></script>
<!-- ============================================================== -->
<!-- This is data table -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection