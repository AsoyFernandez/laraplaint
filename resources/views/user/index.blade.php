@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
              </ol>
            </nav>
            <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">Daftar Pengguna</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                  <p><a class="btn btn-primary" href="{{ route('user.create') }}">Tambah</a></p>
                       <div class="table-responsive">
                        <table id="my" class="display dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @forelse ($user as $log)
                                    <tr>   
                                        <td>{{ $log->nik }}</td>
                                        <td>
                                            {{ $log->name }}
                                        </td>
                                        <td>{{ $log->role->nama }}</td>
                                        <td>{{ $log->email }}</td>
                                        <td>
                                            @include('user.action') 
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

        </div>
    </div>
</div>
@endsection

@section('js')
    
    <script> console.log('Hi!'); </script>
    <script>
        $(document).ready(function() {
            var table = $('#my').DataTable({
                "paging": true,
                "searchable": false,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "columnDefs": [
                    {"targets": 0},
                    {"targets": 1},
                    {"targets": 2},
                    {"targets": 3},
                    {"targets": 4,
                        render: function (text) {
                                text = '<span class="text text-primary">' + text + '</span>';
                            return text;
                        }}
                ],
                "order": [[ 3, "desc" ]]
            });

            $('#my tfoot th').each(function () {
                var title = $(this).text();
                var elem = '';
                  if (title == 'Role') {
                        elem = '<select class="form-control" name="role"><option value="">Semua</option><option value="Outlet Leader">Outlet Leader</option> <option value="Teknisi">Teknisi</option> <option value="Supervisor Area">Supervisor Area</option> <option value="Super User">Super User</option> </select>';
                    }else{
                        elem = '<input class="form-control" type="text" placeholder="' + title + '" />';
                    }
                $(this).html(elem);
            });

            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input, select', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value, true, false).draw();
                    }
                });
            });

   });
    </script>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'user' => Auth::user(),
            'csrfToken' => csrf_token(),
            'vapidPublicKey' => config('webpush.vapid.public_key'),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
        ]) !!};
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        // Push.Permission.request(onGranted, onDenied);
        Push.create("Berhasil!", {
            body: '{{ $message }}',
            icon: '/icon.png',
            link: '{{ $url }}',
            timeout: 4000,
            onClick: function () {
                window.focus();
                this.close();
            }
        });
    });
</script>
@stop
