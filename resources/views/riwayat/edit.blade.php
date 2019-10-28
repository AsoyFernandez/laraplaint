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
                <li class="breadcrumb-item active" aria-current="page">Edit Bukti Penanganan</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Edit Bukti Penanganan</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>

                    </div>
                <div class="box-body">
                  <form method="POST" action="{{ route('riwayat.update', [$pengaduan, $riwayat]) }}" enctype="multipart/form-data">
                        @csrf
                      {{ method_field('PUT') }}

                        
                        <div class="form-group row">
                            <label for="status" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6 radio">
                                <label><input type="radio" required="" value="0" name="status" {{ old('status', $riwayat->status) == "0" ? 'checked' : '' }}>Tunggu</label>
                              <label><input type="radio" value="1" required="" name="status" {{ old('status', $riwayat->status) == "1" ? 'checked' : '' }}>Selesai</label>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Foto') }}</label>
 
                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}" autocomplete="foto" autofocus onchange="openFile(event)">
                                <center>
                                @if (isset($pengaduan) && $pengaduan->foto)
                                <img id="output" class="img-rounded img-responsive " style="width: 20rem; height: 20rem" src="{!!asset('img/'.$pengaduan->foto)!!}">
                              @else
                                 Foto belum di upload
                              @endif
                            </center>
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
                                <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}" autocomplete="keterangan" autofocus>{{ $riwayat->keterangan }}</textarea>
                                
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
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
    <script>
        
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
    </script>
@stop
