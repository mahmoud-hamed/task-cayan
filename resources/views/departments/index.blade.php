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
            <h4 class="content-title mb-0 my-auto">{{ __('admin.departments') }}
            </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{ __('admin.departments') }}
            </span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection

@section('content')
@if (session()->has('delete'))
<script>
toastr.error("{{ __('admin.delete_successfully') }}")
</script>
@endif

@if (session()->has('error'))
<script>
toastr.error("{{ __('admin.Cannot delete the department because it has associated users.') }}")
</script>
@endif

@if (session()->has('Add'))
<script>
toastr.success("{{ __('admin.added_successfully') }}")
</script>
@endif
@if (session()->has('edit'))
<script>
toastr.success("{{ __('admin.update_successfullay') }}")
</script>
@endif


<div class="page-wrapper">

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#createModal">
                                        {{ __('admin.add') }}
                                    </button>
                                </div>
                                <div class="col">
                                    <form method="GET" action="{{ route('departments.search') }}" class="form-inline">
                                        <div class="form-group">
                                            <select name="department" id="department" class="form-control">
                                                <option value="">{{ __('admin.departments') }}</option>
                                                @foreach ($departmetns as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary " style="margin-right: 10px;">{{__('admin.search')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="card-body border-bottom py-3">
                            <div class="table-responsive text-center">
                                <table class="table table-hover mb-0 text-md-nowrap" id="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">#</th>

                                            <th style="text-align:center">{{ __('admin.name') }}</th>

                                            <th style="text-align:center">{{ __('admin.control') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($departmetns as $key=>$item)

                                        <tr class="align-self-center" id="test">
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                {{ $item->name }}
                                            </td>

                                            <td>
                                                <span class=" btn round btn-outline-danger delete-row text-danger"
                                                    data-url="{{ url('department/delete/' . $item->id) }}">
                                                    <i class="fa-solid fa-trash"></i></span>

                                                <a class=" btn round btn-outline-primary  text-primary update_package_form"
                                                    data-toggle="modal" data-target="#updateModal"
                                                    data-id="{{ $item->id }}" data-name="{{ $item->name}}">
                                                    <i class="fa-solid fa-edit"></i></a>
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
@include('departments.modal')

@endsection

@section('js')





{{-- delete one user script --}}
@include('dashboard.shared.deleteOne')
{{-- delete one user script --}}






@endsection