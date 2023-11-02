<div class="row row-sm">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">اضافة مستخدم</a>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>

                    <input type="search" wire:model="search" class="form-control float-end mx-10" placeholder="Search..."
            style="width: 230px; margin-bottom:10px;" />

                </div>


            </div>

            
            <div class="card-body">
                <div class="table-responsive border-top userlist-table">
                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0 ">
                        <thead>
                            <tr>

                                <th class="wd-lg-8p"><span>#</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.image')}}</span></th>

                                <th class="wd-lg-20p"><span>{{__('admin.name')}}</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.email')}}</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.salary')}}</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.manager')}}</span></th>

                                <th class="wd-lg-20p">{{ __('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    @isset($user->attachmentRelation[0])
                                    <div class="position-relative">
                                        @if ($i === 1)
                                        <span class="badge badge-warning position-absolute top-0 start-0">
                                            <i class="fa fa-star" style="color:gold;"></i>
                                        </span>
                                        @endif
                                        <img src="{{ asset($user->attachmentRelation[0]->path) }}" alt="avatar"
                                            height="60" style="border-radius: 20px;">
                                    </div>
                                    @else
                                    @if ($i === 1)
                                    <span class="badge badge-warning position-absolute top-0 start-0">
                                        <i class="fa fa-star" style="color:gold;"></i>
                                    </span>
                                    @endif
                                    <img src="{{ asset('assets/img/profile.png') }}" alt="avatar" height="60">
                                    @endisset
                                </td>
                                <td>{{ $user->getFullNameAttribute() }} </td>
                                <td>{{ $user->email }}</td>

                                <td>{{ $user->salary }}</td>
                                <td>{{ $user->manager->name ?? null }}</td>


                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
                                        title="تعديل"><i class="las la-pen"></i></a>

                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                        data-user_id="{{ $user->id }}" data-username="{{ $user->name }}"
                                        data-toggle="modal" href="#modaldemo8" title="حذف"><i
                                            class="las la-trash"></i></a>
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
                                <form action="{{ route('users.destroy', 'test') }}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                        <input type="hidden" name="user_id" id="user_id" value="">
                                        <input class="form-control" name="username" id="username" type="text" readonly>
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
                {{ $data->links() }}

            </div>

        </div>

    </div><!-- COL END -->
</div>
<!-- row closed  -->
</div>
<!-- Container closed -->
</div>
