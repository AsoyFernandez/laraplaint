<form method="POST" action="{{ route('user.destroy', $log->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
</form>