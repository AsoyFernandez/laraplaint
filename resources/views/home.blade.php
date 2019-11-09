@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="box box-solid box-primary">
                <div class="box-header">Selamat Datang</div>

                <div class="box-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    Selamat datang di aplikasi LaraPlaint 
                    
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
<script>
    $(document).ready(function() {
    var table = $('#exampl').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: {
            details: {
                type: 'column',
                target: 0
            }
        },
    });
} );
</script>
@stop