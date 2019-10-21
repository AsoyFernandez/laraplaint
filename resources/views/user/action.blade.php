               <form method="POST" action="{{ route('user.destroy', $log->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <a class="btn btn-primary btn-xs" href="{{ route('user.show', $log->id) }}"><span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Lihat Daftar Lokasi"></span></a>
       <a class="btn btn-primary btn-xs" href="{{ route('user.edit', $log->id) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></span></a>
    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
</form>