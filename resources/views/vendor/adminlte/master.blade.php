<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 2'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/Ionicons/css/ionicons.min.css') }}">

    @include('adminlte::plugins', ['type' => 'css'])

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rowReorder.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.dataTables.min.css') }}" rel="stylesheet">
    
    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
</head>

<body class="hold-transition @yield('body_class')" style="table-layout: fixed;">

@yield('body')

{{-- <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script> --}}
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" ></script>

<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

{{-- <script src="{{ asset('js/dataTables.rowReorder.min.js') }}"></script>

 --}}
 <script src="{{ asset('js/push.js') }}" ></script>
 <script src="{{ asset('js/serviceWorker.min.js') }}" ></script>
 <script src="{{ asset('js/datatables.js') }}" ></script>
<script src="{{ asset('js/validator.min.js') }}"></script>

<script>

    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable({
        responsive:true,
        dom: 'l Bfrtip',
       buttons: [
       {
            extend: 'print',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'pdf',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'excel',
            exportOptions: {
                columns: ':visible'
            }
        },
            'colvis'
       ],
        columnDefs: [ {
            targets: [-1],
            visible: true
        } ],

    });
    
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

        $('.js-example-basic-single').select2({
        placeholder: 'Silahkan pilih data',
        allowClear: true,
        minimumInputLength: 2,
    });

        $('.js-example').select2({
        placeholder: 'Silahkan pilih data',
        allowClear: true,
    });

        $('.js-example-basic-multiple').select2({
        placeholder: 'Silahkan pilih data',
        allowClear: true,
        multiple: true,
    });
        // var selectedValues = $("#lokasi").val().split(',');
        // $(".js-example-basic-multiple").select2('val',selectedValues);
        

} );
</script>


<script>


$(document).ready( function () {
    $(function () {
      $('[data-toggle="popover"]').popover({
        delay: { "show": 500, "hide": 100 }
      })
    });

// var t = $('#example').DataTable(

//     {
//         "language": {
//                 "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
//             },
//         responsive:false,
     
//        dom: 'l Bfrtip',
//        buttons: [
//        {
//             extend: 'print',
//             exportOptions: {
//                 columns: ':visible'
//             }
//         },
//         {
//             extend: 'pdf',
//             exportOptions: {
//                 columns: ':visible'
//             }
//         },
//         {
//             extend: 'excel',
//             exportOptions: {
//                 columns: ':visible'
//             }
//         },
//             'colvis'
//        ],
//         columnDefs: [ {
//             targets: [-1],
//             visible: true
//         } ],
     
// }
// );
    
    //////////////////DataTable
    
    


 
    
    
} );
    </script>
@include('adminlte::plugins', ['type' => 'js'])
@include('sweetalert::alert')
@yield('adminlte_js')
    @include('sweet::alert')
</body>
</html>
