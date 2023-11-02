<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
    @include('layouts.head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">


    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('cdns/js/jquery-3.6.1.min.js') }}" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous"></script>

    {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> --}}
    <script src="{{ asset('cdns/js/pusher.min.js') }}"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">  -->
    <link href="{{ asset('cdns/css/toastr.min.css') }}" rel="stylesheet">


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script src="{{ asset('cdns/js/toastr.min.js') }}"></script>

    {{-- <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('cdns/css/filepond.css') }}">

    <!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
    <!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" -->
    <script src="{{ asset('cdns/js/axios.min.js') }}"></script>

    <!-- the fileinput plugin styling CSS file -->
    <style>
        .floating-timer {
            position: fixed;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            z-index: 9999;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Adjust styles for the timer display and buttons */
        .floating-timer #timer {
            font-size: 24px;
        }

        .floating-timer .btn {
            width: 100%;
            margin-bottom: 5px;
        }
    </style>

    <style>
        .toggle.ios,
        .toggle-on.ios,
        .toggle-off.ios {
            border-radius: 20rem;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20rem;
        }

        .toggle-on.btn {
            background-color: green !important;
        }

        .toggle-off.btn {
            background-color: red !important;
            color: #fff !important;
        }
    </style>

</head>

<body class="main-body">
    <!-- Loader -->
    <div id="global-loader">
        <div class="spinner-grow text-info loader-img" role="status">
            <span class="sr-only">Loading...</span>
        </div>

    </div>

    <!-- /Loader -->
    @include('layouts.main-sidebar')
    @include('layouts.sidebar')

    <!-- main-content -->
    <div class="main-content app-content">
        @include('layouts.main-header')
        <!-- container -->
        <div class="container-fluid">
            @yield('page-header')
            @yield('content')
            @include('layouts.models')
            @include('layouts.footer')
            @include('layouts.footer-scripts')

        </div>
    </div>



</body>

</html>

<script>
    setInterval(function() {
        $("#notifications_count").load(window.location.href + " #notifications_count");
        $("#unreadNotifications").load(window.location.href + " #unreadNotifications");
    }, 5000);
</script>

{{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script> --}}
<script src="{{ asset('cdns/js/pusher.min.js') }}"></script>


{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
{{-- <link rel="stylesheet" href="{{ asset('cdns/css/toastr.min.css') }}"> --}}

{{-- <script src="{{ asset('cdns/js/jquery-3.6.1.min.js') }}"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
crossorigin="anonymous"></script>
--}}


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
<script src="{{ asset('cdns/js/toastr.min.js') }}"></script>

{{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
<script src="{{ asset('cdns/js/axios.min.js') }}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

  
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.0/axios.min.js"
    integrity="sha512-aoTNnqZcT8B4AmeCFmiSnDlc4Nj/KPaZyB5G7JnOnUEkdNpCZs1LCankiYi01sLTyWy+m2P+W4XM+BuQ3Q4/Dg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script src="{{ asset('cdns/js/timer.js') }}"></script>

<script>
    const translations = {
        totalRevenue: '{{ trans('admin.Order_revenue') }}',
        orderCount: '{{ trans('admin.order_count') }}',
    };
</script>
<script src="{{ asset('cdns/js/charts.js') }}"></script>
