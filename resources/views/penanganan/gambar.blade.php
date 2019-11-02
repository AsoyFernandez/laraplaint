<div id="{{ $log->pengaduan->id . 'gambar' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informasi Kerusakan</h4>
      </div>
      <div class="modal-body">
        <center>
          <h4>Kerusakan {{ $log->pengaduan->mesin->nama }} pada {{ $log->pengaduan->lokasi->nama }}</h4>
          @if (isset($log->pengaduan) && $log->pengaduan->foto)
              <img class="img-rounded img-responsive " style="width: 20rem; height: 20rem" src="{!!asset('img/'.$log->pengaduan->foto)!!}">
          @else
             Foto belum di upload
          @endif
          {{ $log->pengaduan->created_at }}
          <br>
          {{ $log->pengaduan->keterangan }}
          <br>
          {{ $log->pengaduan->user->name }}
        </center>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>