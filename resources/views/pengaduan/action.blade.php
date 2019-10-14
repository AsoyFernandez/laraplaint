<form method="POST" action="{{ route('pengaduan.destroy', $log->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
       <a class="btn btn-primary btn-xs" href="{{ route('pengaduan.edit', $log->id) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></span></a>
       @if ($log->status == 1)
       	{{-- expr --}}
       <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'bukti' }}"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true" data-toggle="tooltip" title="Upload Bukti"></span></a>
       @elseif($log->status != 1)
       <a class="btn btn-primary btn-xs disabled" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'bukti' }}"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true" data-toggle="tooltip" title="Upload Bukti"></span></a>
       @endif
       @if ($log->status == 0)
       	<a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'tangani' }}"><span class="glyphicon glyphicon-random" aria-hidden="true" data-toggle="tooltip" title="Tangani"></span></a>
       	@else
       	<a class="btn btn-primary btn-xs disabled" href="#"><span class="glyphicon glyphicon-random" aria-hidden="true" data-toggle="tooltip" title="Tangani"></span></a>
       @endif
       <a class="btn btn-primary btn-xs" href="{{ route('pengaduan.show', $log->id) }}"><span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Lihat Riwayat Penangananp"></span></a>
    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
</form>
@if ($log->status == 0)
@include('pengaduan.tangani', ['object' => $log])
@else
@include('pengaduan.bukti', ['object' => $log])
@endif