Supervisor
@foreach ($pengaduan as $log)
 @if (in_array($log->lokasi_id, $lokasiUser))
                                 {{-- expr --}}
                                                         
                                    <tr>
                                        <td><a href="#myModal" id="openBtn" data-toggle="modal" data-target="{{ '#' . $log->id . 'gambar' }}">{{ $log->no_pengaduan }}</a>
                                            @include('pengaduan.gambar', ['object' => $log])</td>
                                        <td>{{ $log->mesin->nama }}</td>
                                        <td>{{ $log->lokasi->nama }}</td>
                                        @if($log->status == 0)
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
                                        @include('pengaduan.action') 
                                        </td>
                                    </tr>
        @endif
                                @endforeach