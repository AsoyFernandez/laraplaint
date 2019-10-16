<div id="{{ $log->id . 'qr' . '-modal' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">QR Code Untuk {{ $log->nama }}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-3 col-md-offset-3">
              
                @php
                    QRCode::url(route('pengaduan.createQR', [$lokasi->id, $log->id]))->setSize(7)->svg();
                // QRCode::text(1    )->setSize(7)->svg();
                @endphp
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <a type="button" class="btn btn-primary" href="{{ route('qr.create', [$lokasi->id, $log->id]) }}">Download</a>
      </div>
    </div>
  </div>
</div>