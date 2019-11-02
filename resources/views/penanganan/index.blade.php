@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penanganan</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Daftar Penanganan</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                       <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped display responsive nowrap compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No Pengaduan</th>
                                    <th>Lokasi</th>
                                    <th>Mesin</th>
                                    <th>Konfirmasi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($penanganan as $log)
                                    <tr>
                                        <td><a href="" data-toggle="modal" data-target="{{ '#' . $log->pengaduan->id . 'gambar' }}">{{ $log->pengaduan->no_pengaduan }}</a>
                                            @include('penanganan.gambar', ['object' => $log])</td>
                                        <td>{{ $log->pengaduan->lokasi->nama }}</td>
                                        <td>{{ $log->pengaduan->mesin->nama }}</td>
                                        <td>{{ $log->created_at }}</td>
                                        <td>@if ($log->pengaduan->status == 2)
                                            Dalam Penanganan
                                            @elseif($log->pengaduan->status == 3)
                                            Selesai
                                            @elseif($log->pengaduan->status == 4)
                                            Tarik HO
                                        @endif</td>
                                        <td>@include('penanganan.action')</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No Pengaduan</th>
                                    <th>Lokasi</th>
                                    <th>Mesin</th>
                                    <th>Konfirmasi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>

        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
@stop
