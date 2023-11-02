@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
@section('title')
{{ __('admin.tasks') }}

@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('admin.tasks') }}</h4><span
                class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                {{__('admin.tasks')}}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <div class="card">
            @can('إنشاء مهمه')
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary btn-sm" href="{{ route('tasks.create') }}"> {{__('admin.add')}}</a>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>


                </div>


            </div>
            @endcan


            <div class="card-body">
                <div class="table-responsive border-top userlist-table">
                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0 ">
                        <thead>
                            <tr>

                                <th class="wd-lg-8p"><span>#</span></th>

                                <th class="wd-lg-20p"><span>{{__('admin.title')}}</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.description')}}</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.employee')}}</span></th>

                                <th class="wd-lg-20p">{{ __('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($data as $key => $task)
                            <tr>
                                <td>{{ $i }}</td>

                                <td>{{ $task->name }}</td>

                                <td>{{ $task->description }}</td>
                                <td>{{ $task->user->getFullNameAttribute() }} </td>

                                <td class="status">
                                    <select id="status-{{ $task->id }}" class="form-control">
                                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="finished"
                                            {{ $task->status == 'finished' ? 'selected' : '' }}>Finished</option>
                                        
                                    </select>
                                </td>


                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info"
                                        title="تعديل"><i class="las la-pen"></i></a>
                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal" id="modaldemo8">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close"
                                        data-dismiss="modal" type="button"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{ route('tasks.destroy', 'test') }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                        <input type="hidden" name="task_id" id="task_id" value="">
                                        <input class="form-control" name="taskname" id="taskname" type="text" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">الغاء</button>
                                        <button type="submit" class="btn btn-danger">تاكيد</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-auto">

            </div>

        </div>

    </div><!-- COL END -->
</div>
<!-- row closed  -->
</div>
<!-- Container closed -->
</div>




<!-- main-content closed -->
@endsection
@section('js')

<script>
    $(document).ready(function() {
        $('select').change(function() {
            var select = $(this);
            var taskId = select.attr('id').replace('status-', '');
            var newStatus = select.val();

            // Make an AJAX request to update the status
            $.ajax({
                method: 'POST',
                url: '/tasks/update-status/' + taskId,
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function(data) {
                    // Display a success message or handle the response as needed
                    toastr.success(data.message, 'Success');
                }
            });
        });
    });
</script>


<!-- Internal Nice-select js-->
<script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>

<!--Internal  Parsley.min js -->
<script src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
<!-- Internal Form-validation js -->
<script src="{{ URL::asset('assets/js/form-validation.js') }}"></script>
@endsection