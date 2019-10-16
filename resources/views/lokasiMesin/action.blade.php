<form method="POST" action="{{ route('lokasiMesin.destroy', [$lokasi, $log->id]) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="{{ '#' . $log->id . 'qr' . '-modal' }}"><span class="fa fa-qrcode" aria-hidden="true" data-toggle="tooltip" title="Generate QR Code"></span></a>
    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
</form>
@include('lokasiMesin.qrcode', ['object' => $log])