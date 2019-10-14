<div id="{{ $log->id . 'bukti' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Bukti Penanganan {{ $log->no_pengaduan }}</h4>
      </div>

      <div class="modal-body">
          <form method="POST" action="{{ route('riwayat.store') }}" enctype="multipart/form-data">
                        @csrf

                        @if (!is_null($log->penanganan))
                          {{-- expr --}}
                        <input type="hidden" value="{{ $log->penanganan->id }}" name="penanganan_id">
                        @endif

                        <div class="form-group row">
                            <label for="status" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-single form-control" name="status" style="width: 100%">
                                  <option value="" disabled selected></option>
                                  <option value="0">Tunggu</option>
                                  <option value="1">Selesai</option>
                                  
                                </select>

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
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
@stop
