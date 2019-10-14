<div id="{{ $log->id . 'tangani' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pengaduan {{ $log->no_pengaduan }}</h4>
      </div>

      <div class="modal-body">
          <center>
            <h3>Tangani Pengaduan?</h3>
            <br>
          </center>
      <div class="modal-footer">
        <form method="POST" action="{{ route('penanganan.store') }}">
        {{ csrf_field() }}
        {{ method_field('POST') }}
          <input type="hidden" name="user_id" value="{{ Auth::id() }}">
          <input type="hidden" name="pengaduan_id" value="{{ $log->id }}">
          <button type="submit" class="btn btn-primary">Tangani</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </form>
      </div>
    </div>
  </div>
</div>
