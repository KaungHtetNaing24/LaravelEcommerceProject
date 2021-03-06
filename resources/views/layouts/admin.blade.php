<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>




    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    
    
    
    <!-- Styles -->
    
    <link href="{{ asset('admin/css/material-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">

</head>
<body>

    <div class="wrapper">
        @include('layouts.inc.sidebar')
        <div class="main-panel">
            @yield('nav')
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.inc.adminfooter')

        </div>
    </div>
        <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/js/popper.min.js') }}"></script>
        <script src="{{ asset('admin/js/bootstrap-material-design.min.js') }}"></script>
        <script src="{{ asset('admin/js/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('admin/js/jquery.bootstrap-wizard.js') }}"></script>
        <script src="{{ asset('admin/js/material-dashboard.js?v=2.1.2') }}" type="text/javascripts"></script>
        
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('status'))
            <script>
                Swal.fire({
                    position: 'top',
                    text:("{{ session('status') }}"),
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2500,
                    })
            </script>
    @endif
    @yield('scripts')
</body>
</html>
