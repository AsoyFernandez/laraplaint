<div id="{{ $log->id . 'ditolak' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informasi Pengaduan</h4>
      </div>
      <div class="modal-body">
          <div class="table">
            <table class="table table-hover table-bordered table-responsive">
                <thead style="font-weight: bold;">
                  <tr>
                    <td>Keterangan</td>
                    <td>Mengetahui</td>
                    <td>Waktu Konfirmasi</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @if ($log->konfirmasi->keterangan == null)
                    <td>Tanpa Keterangan</td>
                    @else
                    <td>{{ $log->konfirmasi->keterangan }}</td>
                    @endif
                    <td>{{ $log->konfirmasi->user->name }}</td>
                    <td>{{ $log->konfirmasi->created_at }}</td>
                  </tr>
                </tbody>
                <tfoot style="font-weight: bold;">
                  <tr>
                    <td>Keterangan</td>
                    <td>Mengetahui</td>
                    <td>Waktu Konfirmasi</td>
                  </tr>
                </tfoot>
            </table>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>