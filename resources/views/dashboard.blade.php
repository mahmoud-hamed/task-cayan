@extends('layouts.master')
@section('title')
{{ __('admin.home') }}
@stop
@section('css')
<!--  Owl-carousel css-->
<link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('admin.welcome') }}</h2>
            <p class="mg-b-0">{{ __('admin.mond') }}</p>
        </div>
    </div>
 


</div>
<!-- /breadcrumb -->
@endsection
@section('content')

@if (session()->has('success'))
<script>
toastr.success("{{ __('admin.update_successfully') }}")
</script>
@endif
@if (session()->has('noti'))
<script>
toastr.success("{{ __('admin.noti') }}")
</script>
@endif
@if (session()->has('login'))
<script>
toastr.success("{{ __('admin.login') }}")
</script>
@endif

<!-- row -->
@endsection
@section('js')

<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Moment js -->
<script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<!--Internal  Flot js-->
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
<script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
<script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
<!--Internal Apexchart js-->
<script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
<!-- Internal Map -->
<script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
<!--Internal  index js -->
<script src="{{ URL::asset('assets/js/index.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>

@endsection
