<div id="{{ $log->id . 'konfirmasi' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi pengaduan</h4>
      </div>
      <div class="modal-body">
                <form method="POST" id="konfirmasi" action="{{ route('konfirmasi.store') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="pengaduan_id" value="{{ $log->id }}">

                        <div class="form-group row">
                            <label for="status" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6 radio required">
                              <label><input type="radio" value="0" name="status">Tolak</label>
                              <label><input type="radio" value="1" name="status">Publikasi</label>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                              <textarea name="keterangan" cols="30" rows="3" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ old('keterangan') }}" autocomplete="keterangan" placeholder="Keterangan bersifat opsional" autofocus></textarea>

                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            
      </div>
      <div class="modal-footer">

        <button type="submit" id="submitBtn"  class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                    </form>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@section('js')
<script>
$(document).ready(function(){
    $("#submitBtn").click(function(){        
        $("#konfirmasi").submit(); // Submit the form
    });
}); 
</script>
@stop