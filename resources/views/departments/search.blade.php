<!-- Display the search results for users -->

@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
{{ __('admin.department') }}
@stop


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('admin.department') }}
            </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{ __('admin.department') }}
            </span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-wrapper">

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                         
                         

                        </div>

                        <div class="card-body border-bottom py-3">
                            <div class="table-responsive text-center">
                                <table class="table table-hover mb-0 text-md-nowrap" id="table">
                                    <thead>
                                        <tr>

                                            <th style="text-align:center">{{ __('admin.count') }}</th>

                                            <th style="text-align:center">{{ __('admin.salary') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($departments as $department)

                                        <tr class="align-self-center" id="test">
                                            <td>
                                            {{ $department->employee_count }}
                                            </td>

                                            <td>
                                            {{ $department->total_salary }}
                                            </td>

                                         

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">{{ __('admin.there_is_no_data_at_the_moment') }}</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

@endsection