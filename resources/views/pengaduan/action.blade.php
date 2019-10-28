<form method="POST" action="{{ route('pengaduan.destroy', $log->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
       <a class="btn btn-primary btn-xs" href="{{ route('pengaduan.edit', $log->id) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></span></a>
       @if ($log->status < 1)
       <a class="btn btn-primary btn-xs" disabled href="#"><span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Lihat Riwayat Penanganan"></span></a>
       @else
       <a class="btn btn-primary btn-xs" href="{{ route('pengaduan.show', $log->id) }}"><span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Lihat Riwayat Penanganan"></span></a>
       @endif
    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
</form>
