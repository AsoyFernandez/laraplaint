<form method="POST" action="{{ route('lokasi.destroy', $log->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
       <a class="btn btn-primary btn-xs" href="{{ route('lokasi.edit', $log->id) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></span></a>
       <a class="btn btn-primary btn-xs" href="{{ route('lokasiMesin.create', $log->id) }}" id="openBtn" data-toggle="modal" data-target="#"><span class="
glyphicon glyphicon-plus" aria-hidden="true" data-toggle="tooltip" title="Tambah Mesin"></span></a>
    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
</form>