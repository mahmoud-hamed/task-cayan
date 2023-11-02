@extends('layouts.master')

@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
@endsection
@section('title')
    {{ __('admin.add') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('admin.users') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('admin.add_user') }}
                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="page-wrapper">
        <div class="container-xl py-3">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('admin.add') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('admin.first_name') }}</label>
                            <input class="form-control" name="first_name" type="text" required
                                data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('admin.last_name') }}</label>
                            <input class="form-control" name="last_name" type="text" required
                                data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('admin.salary') }}</label>
                            <input class="form-control" name="salary" type="text" required
                                data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('admin.manager') }}</label>
                            <input readonly class="form-control"  value="{{auth()->user()->name}}">
                            <input type="hidden" name="manager_id" value="{{ auth()->user()->id }}">

                        </div>

                        <div class="mb-3 ">
                            <label class="form-label">{{ __('admin.image') }}</label>

                            <div class="form-group mb-3">
                                <input name="image" type="file" class="form-control">

                            </div>
                            <div class="form-group">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">{{ __('admin.confirm') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @push('js')
    <script>
        $(document).ready(function() {
            $("#input-b8").fileinput({
                rtl: true,
                dropZoneEnabled: false,
                allowedFileExtensions: ["jpg", "png", "gif"]
            });
        });
        </script>
    @endpush
