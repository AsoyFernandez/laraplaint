@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pengaduan.index') }}">Pengaduan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat Penanganan</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Riwayat Penanganan Pengaduan {{ $pengaduan->no_pengaduan }}</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                  <p><a class="btn btn-primary" href="{{ route('pengaduan.create') }}">Tambah</a></p>
                       <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped display responsive nowrap compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @if (!is_null($pengaduan->penanganan))
                                @if (!is_null($pengaduan->penanganan->riwayats))
                                @foreach ($pengaduan->penanganan->riwayats as $log)
                                    <tr>   
                                        <td>{{ $pengaduan->no_pengaduan }}</td>
                                        @if ($log->status == 0)
                                        <td>Menunggu</td>
                                        @else
                                        <td>Selesai</td>
                                        @endif
                                        <td>{{ $log->keterangan }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach
                                @endif
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
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
