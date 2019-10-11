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
                <li class="breadcrumb-item active" aria-current="page">Ubah Pengguna</li>
              </ol>
            </nav>
                <div class="box box-primary">
    <div class="box-header">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
          <li><a data-toggle="tab" href="#password">Password</a></li>
        </ul>
    </div>
    <div class="box-body">
        <div class="tab-content">
          <div id="profile" class="tab-pane fade in active">
            <form id="profile" method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="form-group row">
                            <label for="nik" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('NIK') }}</label>

                            <div class="col-md-6">
                                <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $user->nik) }}" required autocomplete="nik" autofocus>

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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="role_id">
                                    @foreach($role as $key)
                                    <option value="{{ $key->id }}" {{ old('lokasi_id', $user->role_id) == $key->id ? 'selected' : '' }}>{{ $key->nama }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>

                                @error('email')
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
                  <div id="password" class="tab-pane fade">
                    <form method="POST" id="myForm" action="{{ route('user.update', $user->id) }}" data-toogle="validator">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="password" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input type="password" name="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" @error('password') is-invalid @enderror required autofocus>
                                <div class="help-block with-errors"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      </div>

                        <div class="form-group row">
                        <label for="inputPasswordConfirm" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">Konfirmasi</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Password belum sama" placeholder="Konfirmasi Password" required>
                                <div class="help-block with-errors"></div>
                                @error('inputPasswordConfirm')
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
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
           $("#myForm").validator();
        });
    </script>
    <script> console.log('Hi!'); </script>
@stop
