<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name') }} | @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg" type="image/x-icon') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png" type="image/png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">

    @stack('css')
</head>

<body>
    <div id="app">
        {{-- sidebar --}}
        @include('layouts.sidebar')
        {{-- end sidebar --}}

        {{-- main --}}
        <div id="main" class='layout-navbar'>
            {{-- header --}}
            @include('layouts.header')
            {{-- end header --}}
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <h3>@yield('title')</h3>
                    </div>
                </div>

                <div class="page-content">
                    <section class="row">
                        <div class="col-12 col-lg-12">
                            @yield('contents')
                        </div>
                    </section>
                </div>

                {{-- footer --}}

                @include('layouts.footer')
                {{-- end footer --}}
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script> --}}

    <!-- jquery -->
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <!-- datatable -->
    <script src="{{ asset('https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js') }}"></script>
    {{-- <script src="assets/js/pages/datatables.js"></script> --}}



    @stack('scripts')

    <!-- data toggle -->


</body>

</html>
