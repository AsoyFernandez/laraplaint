<form method="POST" action="{{ route('penanganan.destroy', $log->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
       @if ($log->pengaduan->status < 1)
       <a class="btn btn-primary btn-xs" disabled href="#"><span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Lihat Riwayat Penanganan"></span></a>
       @else
       <a class="btn btn-primary btn-xs" href="{{ route('pengaduan.show', $log->pengaduan->id) }}"><span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Lihat Riwayat Penanganan"></span></a>
       @endif
    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Batalkan Penanganan?"></span> </button>
</form>
