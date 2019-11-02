@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                @if (!is_null($pengaduan->penanganan))
                    {{-- expr --}}
                @if (Auth::user()->role->id == 3)
                            {{-- expr --}}

                  <p><a class="btn btn-primary" href="{{ route('pengaduan.create') }}">Tambah</a> 
                        <a class="btn btn-primary" href="{{ route('riwayat.show', $pengaduan) }}">Cetak</a></p>
                        @else
                        <p><a class="btn btn-primary" href="{{ route('riwayat.show', $pengaduan) }}">Cetak</a></p>
                        
                        @endif
                @endif
                       <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped display responsive nowrap compact" style="width:100%">
                            <thead>
                                <tr>
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
                                        @if ($log->status == 0)
                                        <td>Menunggu</td>
                                        @elseif ($log->status == 1)
                                        <td>Selesai</td>
                                        @elseif ($log->status == 2)
                                        <td>Tarik Ho</td>
                                        @endif
                                        <td>{{ $log->keterangan }}</td>
                                        <td>{{ $log->created_at }}</td>
                                        <td><form method="POST" action="{{ route('riwayat.destroy', $log->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                       <a class="btn btn-primary btn-xs" href="{{ route('riwayat.edit', [$pengaduan, $log->id]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></span></a>
                                       <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'gambar' }}"><span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Lihat Riwayat Penanganan"></span></a>
                                    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
                                </form>
</td>
@include('riwayat.gambar', ['object' => $log])
                                    </tr>
                                @endforeach
                                @endif
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
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
