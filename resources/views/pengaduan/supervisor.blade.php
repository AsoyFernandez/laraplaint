Supervisor
@foreach ($pengaduan as $log)
 @if (in_array($log->lokasi_id, $lokasiUser))
                                 {{-- expr --}}
                                                         
                                    <tr>
                                        <td><a href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . $log->id . 'gambar' }}">{{ $log->no_pengaduan }}</a>
                                            @include('pengaduan.gambar', ['object' => $log])</td>
                                        <td>{{ $log->user->name }}</td>
                                        <td>{{ $log->mesin->nama }}</td>
                                        <td>{{ $log->lokasi->nama }}</td>
                                        @if($log->status == -1)
                                        <td>Ditolak AS</td>
                                        @elseif($log->status == 0)
                                        <td>Menunggu Konfirmasi AS</td>
                                        @elseif ($log->status == 1)
                                            <td>Belum ditangani</td>
                                            @elseif($log->status == 2)
                                            <td><a href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . $log->id . 'modal' }}">Dalam Penanganan</a>
                                            @include('pengaduan.pic', ['object' => $log])</td>
                                            @elseif($log->status == 3)
                                            <td>Selesai</td>
                                        @endif
                                        <td>{{ $log->keterangan }}</td>
                                        <td>{{ $log->created_at }}</td>
                                        <td>
                                        <form method="POST" action="{{ route('pengaduan.destroy', $log->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
       <a class="btn btn-primary btn-xs" href="{{ route('pengaduan.edit', $log->id) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></span></a>
       <a class="btn btn-primary btn-xs" href="#"><span class="fa fa-question" aria-hidden="true" title="Konfirmasi" data-toggle="modal" data-target="{{ '#' . $log->id . 'konfirmasi' }}"></span></a>
       <a class="btn btn-primary btn-xs" href="{{ route('pengaduan.show', $log->id) }}"><span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Lihat Riwayat Penanganan"></span></a>
    <button type="submit" class="btn btn-warning btn-link btn-xs" onclick="return confirm('Apakah anda serius?')"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" title="Hapus"></span> </button>
</form> 
@include('pengaduan.konfirmasi', ['object' => $log])
                                        </td>
                                    </tr>
        @endif
                                @endforeach