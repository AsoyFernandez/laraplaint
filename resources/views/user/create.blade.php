@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Pengguna</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pengguna</li>
              </ol>
            </nav>
            @if ($errors != '[]')
                {{-- expr --}}
                {{ $errors }}
                @foreach ($errors as $er)
                    <ul>
                        <li>{{ $er }}</li>
                    </ul>
                @endforeach
            @endif
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#kategori">Pengguna</a></li>
                          <li><a data-toggle="tab" href="#import">Import</a></li>
                        </ul>

                    </div>
                <div class="box-body">
                    <div class="tab-content">
          <div id="kategori" class="tab-pane fade in active">                  
                  <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nik" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('NIK') }}</label>

                            <div class="col-md-6">
                                <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>

                                @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_id" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="role_id">
                                  <option value="" disabled selected></option>
                                  @foreach($role as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                  @endforeach
                                </select>

                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lokasi" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Lokasi') }}</label>
                            <div class="col-md-6">
                                <div class="radio">
                                        <label><input type="radio" value="0" id="semua" onclick="show2()" name="optradio">Semua</label>
                                        <label><input name="optradio" value="1" type="radio" id="sebagian" onclick="show1()">Sebagian</label>
                                </div>
                                <div id="lokasi_id" >    
                                <select class="js-example-basic-single form-control" name="lokasi_id[]" multiple="multiple">
                                  @foreach($lokasi as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                  @endforeach
                                </select>
                                </div>
                                @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                                @error('password')
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
                    <form method="POST" action="{{ route('import.user') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row">
                            <label for="template" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Template') }}</label>

                            <div class="col-md-6">
                                <a href="{{ route('template.user') }}" class="btn btn-success btn-xs"><i class="fa fa-cloud-download"></i> Download</a>
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
    <script>
        $(document).ready(function() {
            $("#lokasi_id").hide();
        });

        function show1(){
           $("#lokasi_id").show();
        }

        function show2(){
           $("#lokasi_id").hide();
        }

 
    </script>
@stop
