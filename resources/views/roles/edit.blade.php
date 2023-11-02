@extends('layouts.master')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@section('title')
{{ __('admin.edit_permissions') }} 
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">{{ __('admin.permissions') }}</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('admin.edit_permissions') }}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('roles.update', $role->id) }}" method="post">
    @csrf
    @method('PUT')
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        <div class="form-group">
                            <p>{{__('admin.name')}}</p>
                            <input class="form-control" type="text" placeholder="name"
                                value="{{ $role->name }}"name="name">
                        </div>
                    </div>
                    <div class="row">
                        <!-- col -->
                        <div class="col-lg-4">
                            <ul id="treeview1">
                                <li><a href="#">{{__('admin.permissions')}}</a>
                                    <ul>
                                        <li>
                                            @foreach ($permission as $value)
                                                <label><input type="checkbox" name="permission[]"
                                                        value="{{ $value->id }}"
                                                        {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                    {{ $value->name }}</label>
                                                <br />
                                            @endforeach
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-main-primary">{{__('admin.update')}}</button>
                        </div>
                        <!-- /col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Treeview js -->
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
