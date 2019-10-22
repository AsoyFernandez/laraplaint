<div id="{{ 'lokasi' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Manipulasi Lokasi</h4>
      </div>
      <div class="modal-body">
          <form id="myForm" method="POST" action="{{ route('user.storeLokasi', $user) }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group row">
                            <label for="pengguna" class="col-md-offset-2 col-md-2 control-label col-form-label text-md-right">{{ __('Pengguna') }}</label>

                            <div class="col-md-6">
                                <input id="pengguna" type="text" class="form-control @error('pengguna') is-invalid @enderror" name="pengguna" value="{{ $user->name }}" required autocomplete="pengguna" autofocus disabled="">

                                @error('pengguna')
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
                                <select class="js-example-basic-single form-control" name="lokasi_id[]" style="width: 100%" multiple="multiple">
                                  @foreach($lokasi as $key)
                                    @if(!in_array($key->id, $lokasiUser))
                                    
                                    <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                    @endif
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


{{-- 
                        <div class="form-group row mb-0">
                            <div class="col-md-6 col-md-offset-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div> --}}
                    </form>     
      </div>
      <div class="modal-footer">
        <button id="submitBtn" type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>
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

$(document).ready(function(){
    $("#submitBtn").click(function(){        
        $("#myForm").submit(); // Submit the form
    });
}); 
    </script>
@stop
