@extends('layouts.master')
@section('css')

    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        /* From uiverse.io by @satyamchaudharydev */
        /* this button is inspired by -- whatsapp input */
        /* == type to see fully interactive and click the close buttom to remove the text  == */

        .form {
            --input-bg: #FFf;
            --padding: 1.5em;
            --rotate: 80deg;
            --gap: 2em;
            --icon-change-color: #15A986;
            --height: 40px;
            width: 200px;
            padding-inline-end: 1em;
            background: var(--input-bg);
            position: relative;
            border-radius: 4px;
        }

        .form label {
            display: flex;
            align-items: center;
            width: 100%;
            height: var(--height);
        }

        .form input {
            width: 100%;
            padding-inline-start: calc(var(--padding) + var(--gap));
            outline: none;
            background: none;
            border: 0;
        }

        /* style for both icons -- search,close */
        .form svg {
            /* display: block; */
            color: #111;
            transition: 0.3s cubic-bezier(.4, 0, .2, 1);
            position: absolute;
            height: 15px;
            cursor: pointer;
        }

        /* search icon */
        .icon {
            position: absolute;
            left: var(--padding);
            transition: 0.3s cubic-bezier(.4, 0, .2, 1);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* arrow-icon*/
        .swap-off {
            transform: rotate(-80deg);
            opacity: 0;
            visibility: hidden;
        }

        .form input:focus~.icon {
            transform: rotate(var(--rotate)) scale(1.3);
        }

        .form input:focus~.icon .swap-off {
            opacity: 1;
            transform: rotate(-80deg);
            visibility: visible;
            color: var(--icon-change-color);
        }

        .form input:focus~.icon .swap-on {
            opacity: 0;
            visibility: visible;
        }

        .form input:valid~.icon {
            transform: scale(1.3) rotate(var(--rotate))
        }

        .form input:valid~.icon .swap-off {
            opacity: 1;
            visibility: visible;
            color: var(--icon-change-color);
        }

        .form input:valid~.icon .swap-on {
            opacity: 0;
            visibility: visible;
        }

        .form input:valid~.close-btn {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
            transition: 0s;
        }

        /* Add this CSS to your stylesheet or within a <style> tag in your HTML */

        .search-form-container {
            display: flex;
            justify-content: flex-end;
            /* Align content to the right */
            align-items: center;
            /* Vertically center content */
        }

        /* Adjust margin or padding as needed */
        .form {
            margin-right: 20px;
            /* Add margin to separate the form from other elements */
        }
    </style>
@endsection
@section('title')
    {{ __('admin.employee') }}
@stop


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('admin.employee') }} </h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                    {{ __('admin.employee') }}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection


@section('content')


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
    @if (session()->has('delete'))
        <script>
            toastr.error("{{ __('admin.delete_successfully') }}")
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            toastr.error("{{ __('admin.no_delivery') }}")
        </script>
    @endif


    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a href={{ route('employees.create') }} class="modal-effect btn btn-sm btn-primary"
                        style="color:white">
                        <i class="fas fa-plus"></i>&nbsp; {{ __('admin.add') }}
                    </a>

                    <!-- Container for search form -->
              
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                            style="text-align: center">
                            <thead>
                                <tr class="align-self-center">
                                    <th class="border-bottom-0">#</th>
                                    <th style="text-align:center">{{ __('admin.image') }}</th>

                                    <th class="border-bottom-0">{{ __('admin.name') }}</th>

                                    <th class="border-bottom-0">{{ __('admin.salary') }}</th>
                                    <th class="border-bottom-0">{{ __('admin.manager') }}</th>
                                    <th class="border-bottom-0">{{ __('admin.control') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($employees as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            @isset($item->attachmentRelation[0])
                                                <div class="position-relative">
                                                    @if ($i === 1)
                                                        <span class="badge badge-warning position-absolute top-0 start-0">
                                                            <i class="fa fa-star" style="color:gold;"></i>
                                                        </span>
                                                    @endif
                                                    <img src="{{ asset($item->attachmentRelation[0]->path) }}" alt="avatar"
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
                                        <td>{{ $item->getFullNameAttribute() }} </td>
                                        <td>{{ $item->salary }}</td>
                                        <td>{{ $item->manager->name }}</td>

                                        <td>
                                            <a href="{{ route('employees.edit', $item->id) }}"
                                                class="btn round btn-outline-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a class="btn round btn-outline-warning"
                                                href="{{ route('employees.show', $item->id) }}"><i
                                                    class="fa-solid fa-eye"></i></a>

                                            <span class=" btn round btn-outline-danger delete-row text-danger"
                                                data-url="{{ url('employees/delete/' . $item->id) }}"><i
                                                    class="fa-solid fa-trash"></i></span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--/div-->
    </div>

    </div>
    </div>

@endsection

@section('js')

    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchIcon = document.getElementById('search-icon');
            const searchForm = document.getElementById('search-form');

            searchIcon.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default behavior of the anchor tag

                // Trigger the form submission
                searchForm.submit();
            });
        });
    </script>

    {{-- delete one user script --}}
    @include('dashboard.shared.deleteOne')

    {{-- delete one user script --}}

@endsection
