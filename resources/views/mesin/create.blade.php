@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('mesin.index') }}">Mesin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Mesin</li>
              </ol>
            </nav>
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#utama">Mesin</a></li>
                          <li><a data-toggle="tab" href="#import">Import</a></li>
                        </ul>

                    </div>
                <div class="box-body">
                    <div class="tab-content">
          <div id="utama" class="tab-pane fade in active">
                  
                  <form method="POST" action="{{ route('mesin.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="nama" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Kategori') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="kategori_id">
                                  <option value="" disabled selected></option>
                                  @foreach($kategori as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                  @endforeach
                                </select>

                                @error('kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 col-md-offset-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="import" class="tab-pane fade">
                    <form method="POST" action="{{ route('import.mesin') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row">
                            <label for="template" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Template') }}</label>

                            <div class="col-md-6">
                                <a href="{{ route('template.mesin') }}" class="btn btn-success btn-xs"><i class="fa fa-cloud-download"></i> Download</a>
                                @error('template')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="import" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Import') }}</label>

                            <div class="col-md-6">
                                <input id="import" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control @error('import') is-invalid @enderror" name="import" required autofocus />  

                                @error('import')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 col-md-offset-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>                                        
                  </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
@stop
