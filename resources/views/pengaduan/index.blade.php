@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengaduan</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Daftar Pengaduan</h2>

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
                                    <th>Pelapor</th>
                                    <th>Mesin</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                            {{-- Admin --}}
                                @if (Auth::user()->role_id == 1)
                                    @include('pengaduan.admin')
                                @endif
                            {{-- Admin --}}
                            {{-- ol --}}
                                @if (Auth::user()->role_id == 2)
                                    @include('pengaduan.ol')
                                @endif
                            {{-- ol --}}
                            {{-- teknisi --}}
                                @if (Auth::user()->role_id == 3)
                                    @include('pengaduan.teknisi')
                                @endif
                            {{-- teknisi --}}
                            {{-- supervisor --}}
                                @if (Auth::user()->role_id == 4)
                                    @include('pengaduan.supervisor')
                                @endif
                            {{-- supervisor --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Pelapor</th>
                                    <th>Mesin</th>
                                    <th>Lokasi</th>
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
