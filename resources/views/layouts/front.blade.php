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
    <!-- CSS only -->
   
    
    
    
    <!-- Styles -->
    
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    
    <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">

</head>
<body>
    <div class="main-panel">
        @include('layouts.inc.frontnav')
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.inc.frontfooter')
    </div>        



    
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('status'))
            <script>
                Swal.fire({
                    position: 'top',
                    text:("{{ session('status') }}"),
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                    })
                // swal("{{ session('status') }}");
            </script>
    @endif
    @if(session('error'))
            <script>
                Swal.fire({
                    position: 'top',
                    text:("{{ session('error') }}"),
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                    })
                // swal("{{ session('status') }}");
            </script>
    @endif
    @if(session('warn'))
            <script>
                Swal.fire({
                    position: 'top',
                    text:("{{ session('warn') }}"),
                    icon: "warning",
                    showConfirmButton: false,
                    timer: 1500,
                    })
                // swal("{{ session('status') }}");
            </script>
    @endif
    @yield('scripts')

</body>
</html>
