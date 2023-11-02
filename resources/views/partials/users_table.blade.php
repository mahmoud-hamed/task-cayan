<table class="table card-table table-striped table-vcenter text-nowrap mb-0 ">
                        <thead>
                            <tr>

                                <th class="wd-lg-8p"><span>#</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.name')}}</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.email')}}</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.status')}}</span></th>
                                <th class="wd-lg-20p"><span>{{__('admin.type')}}</span></th>

                                <th class="wd-lg-20p">{{ __('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>

                                    @if ($user->Status == 'مفعل')
                                    <span class="label text-success d-flex">
                                        {{ $user->Status }} <div class="dot-label bg-success ml-1 "
                                            style="margin-right:10"></div>
                                    </span>
                                    @else
                                    <span class="label text-danger d-flex">
                                        <div class="dot-label bg-danger ml-1" style="margin-right:10"></div>
                                        {{ $user->Status }}
                                    </span>
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                    @endif
                                </td>

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