@extends('layouts.master')
@section('css')

@section('title')
{{ __('admin.admins') }}
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('admin.employees') }}
            </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('admin.employees') }}

            </span>
        </div>
    </div>


</div>
<!-- breadcrumb -->
@endsection
@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div>
       <livewire:employee-search>

   </div>

<!--Row-->
<!-- main-content closed -->
@endsection


@section('js')


<script>
$('#modaldemo8').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var user_id = button.data('user_id')
    var username = button.data('username')
    var modal = $(this)
    modal.find('.modal-body #user_id').val(user_id);
    modal.find('.modal-body #username').val(username);
})
</script>


@endsection