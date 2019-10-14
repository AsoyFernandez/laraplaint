<div id="{{ $log->id . 'modal' }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informasi PIC</h4>
      </div>
      <div class="modal-body">
          <div class="table">
            <table class="table table-hover table-bordered table-responsive">
                <thead style="font-weight: bold;">
                  <tr>
                    <td>Lokasi</td>
                    <td>Mesin</td>
                    <td>PIC</td>
                    <td>Waktu Konfirmasi</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $log->lokasi->nama }}</td>
                    <td>{{ $log->mesin->nama }}</td>
                    <td>{{ $log->penanganan->user->name }}</td>
                    <td>{{ $log->penanganan->created_at }}</td>
                  </tr>
                </tbody>
                <tfoot style="font-weight: bold;">
                  <tr>
                    <td>Lokasi</td>
                    <td>Mesin</td>
                    <td>PIC</td>
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