<div id="{{ $log->id . 'gambar' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informasi Penanganan</h4>
      </div>
      <div class="modal-body">
        <center>
          <h4>Pengaduan : {{ $log->penanganan->pengaduan->no_pengaduan }} </h4>
          @if (isset($log) && $log->foto)
              <img class="img-rounded img-responsive " style="width: 20rem; height: 20rem" src="{!!asset('img/'.$log->foto)!!}">
          @else
             Foto belum di upload
          @endif
          PIC : {{ $log->penanganan->user->name }}
          <br>
          {{ $log->created_at }}
          <br>
          {{ $log->keterangan }}
        </center>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>