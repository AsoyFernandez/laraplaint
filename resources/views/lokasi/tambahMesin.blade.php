<div id="{{ $log->id . 'tambahStok' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Stok {{ $log->nama }}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <center>  
              <form method="POST" id="myForm" action="{{ route('stok.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('POST') }}
                                    <input type="hidden" name="barang_id" value="{{ $log->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <div class="form-group row">
                                        <label for="jumlah" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Jumlah') }}</label>

                                        <div class="col-md-6">
                                            <input id="jumlah" type="number" class="form-control @error('jumlah') is-invalid @enderror" name="qty" value="" required autocomplete="jumlah" autofocus>

                                            @error('jumlah')
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

                    
            </center>
          </div>
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
                                                {{ __('Simpan') }}
                                            </button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>