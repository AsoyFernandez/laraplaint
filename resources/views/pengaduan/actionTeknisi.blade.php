@if (Auth::user()->role->id == 3)
         @if ($log->status == 2 && $log->penanganan->user_id == Auth::id())
         <a class="btn btn-primary btn-xs" href="{{ route('riwayat.create', $log->id) }}"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true" data-toggle="tooltip" title="Upload Bukti"></span></a>
         @elseif($log->status != 2)
         <a class="btn btn-primary btn-xs disabled" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'bukti' }}"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true" data-toggle="tooltip" title="Upload Bukti"></span></a>
         @endif
         @if ($log->status == 1)
         	<a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="{{ '#' . $log->id . 'tangani' }}"><span class="glyphicon glyphicon-random" aria-hidden="true" data-toggle="tooltip" title="Tangani"></span></a>
         	@elseif($log->status != 1)
         	<a class="btn btn-primary btn-xs disabled" href="#"><span class="glyphicon glyphicon-random" aria-hidden="true" data-toggle="tooltip" title="Tangani"></span></a>
         @endif
       @endif

       <a class="btn btn-primary btn-xs" href="{{ route('pengaduan.show', $log->id) }}"><span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Lihat Riwayat Penanganan"></span></a>
@if ($log->status == 1)
@include('pengaduan.tangani', ['object' => $log])
@else
@include('pengaduan.bukti', ['object' => $log])
@endif