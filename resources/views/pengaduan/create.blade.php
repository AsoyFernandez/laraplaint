@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pengaduan.index') }}">Pengaduan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buat Pengaduan</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Buat Pengaduan</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>

                    </div>
                <div class="box-body">
                  <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
                        @if (Request::route()->getName() == "pengaduan.createQR")
                        <input type="hidden" value="{{ $lokasi->id }}" name="lokasi_id">
                        <input type="hidden" value="{{ $mesin->id }}" name="mesin_id">
                        @endif
                        
                        <div class="form-group row">
                            <label for="lokasi" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Lokasi') }}</label>

                            <div class="col-md-6">
                                @if (Request::route()->getName() == "pengaduan.createQR")
                                <select class="js-example-basic-single form-control" name="lokasi_id" disabled="">
                                  <option value="{{ $lokasi->id }}" disabled selected>{{ $lokasi->nama }}</option>
                                </select>
                                @else
                                <select class="lokasi form-control" name="lokasi_id">
                                </select>
                                @endif

                                @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mesin" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Mesin') }}</label>

                            <div class="col-md-6">
                                @if (Request::route()->getName() == "pengaduan.createQR")
                                <select class="js-example-basic-single form-control" name="mesin_id" disabled="">
                                  <option value="{{ $mesin->id }}" disabled selected>{{ $mesin->nama }}</option>
                                </select>
                                @else
                                <select class="mesin form-control" name="mesin_id">
                                  
                                </select>
                                @endif
                                @error('mesin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Foto') }}</label>
 
                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}" autocomplete="foto" required autofocus onchange="openFile(event)">
                                <center>
                                <img id="output" class="img-rounded img-responsive " style="width: 20rem; height: 20rem"></center>
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="Keterangan" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                                <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}" autocomplete="keterangan" autofocus></textarea>
                                
                                @error('keterangan')
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
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
    <script>
        $(document).ready(function() {
            $("#output").hide();
        });
        var openFile = function(event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function(){
          var dataURL = reader.result;
          var output = document.getElementById('output');
          output.src = dataURL;
          $("#output").show();
        };
        reader.readAsDataURL(input.files[0]);
      };
    </script>
    <script>
    $('.mesin').select2({
        placeholder: 'Silahkan cari data',
        minimumInputLength: 2,
        ajax: {
                url: '{{ url(route('mesin.search')) }}',
                processResults: function(data){
                return {
                results: data.map(function(item){return {id: item.id, text:
                item.nama} })
                }
            }
        }
    });
    $('.lokasi').select2({
        placeholder: 'Silahkan cari data',
        minimumInputLength: 2,
        ajax: {
                url: '{{ url(route('lokasi.search')) }}',
                processResults: function(data){
                return {
                results: data.map(function(item){return {id: item.id, text:
                item.nama} })
                }
            }
        }
    });
     // $('.cariMesin').select2({
     //    placeholder: 'Cari...',
     //    minimumInputLength: 3,
     //    ajax: {
     //      url: '{{ url(route('mesin.search')) }}',
     //      dataType: 'json',
     //      delay: 250,
     //      processResults: function (data) {
     //        return {
     //          results:  $.map(data, function (item) {
     //            return {
     //              id: item.id,
     //              text: item.nama,
     //            }
     //          })
     //        };
     //      },
     //      cache: true
     //    }
     //  });
</script>
@stop
