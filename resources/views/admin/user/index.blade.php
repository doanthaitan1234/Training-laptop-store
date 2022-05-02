@extends('layouts.admin-layout')

@section('title')
    <title>{{ __('Admin') }} - {{ __('User') }}</title>
@endsection

@section('header')
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">{{ __('Create') }} {{ __('User') }}</a>
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ __('User List') }}</strong>
                </div>

                <div class="card-body">
                    <table id="users-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __('No.') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Role') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#main-menu ul li').removeClass('active')
        $('#main-menu ul .user').addClass('active')
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // toastr.options.preventDuplicates = true;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#users-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.list') }}",
                language: {
                    "lengthMenu": "{{ __('Display  _MENU_ records per page') }}",
                    "zeroRecords": "{{ __('Nothing found - sorry') }} ",
                    "info": "{{ __('Showing page _PAGE_ of _PAGES_') }}",
                    "infoEmpty": "{{ __('No records available') }}",
                    "infoFiltered": "{{ __('(filtered from _MAX_ total records)') }}",
                    "paginate": {
                        "next": "{{ __('Next') }}",
                        "previous": "{{ __('Previous') }}",
                    },
                    "loadingRecords": "{{ __('Loading') }}...",
                    "processing": "{{ __('Processing') }}...",
                    "search": "{{ __('Search') }}:",
                },
                columnDefs: [{
                    "className": "text-center",
                    "targets": "_all"
                }],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'role.name',
                        name: 'role'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
            });

        });
        $(document).on('click', '#btnDelete', function() {
            var id = $(this).data('id')
            swal.fire({
                title: '{{ __('Are you sure?') }}',
                html: '{{ __('You want to delete this user') }}',
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes, Delete',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',
                width: 300,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ url('admin/users') }}" + '/' + id,
                        success: function(data) {
                            if (data.code == SUCCESS) {
                                $('#users-data-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                            } else {
                                toastr.error(data.msg);
                            }
                        }
                    }, 'json')
                }
            });
        })
        $(document).on('click', '#btnActive', function() {
            var id = $(this).data('id')
            var url = '{{ route('users.changeStatus') }}';
            $.post(url, {
                    user_id: id
                },
                function(data) {
                    if (data.code == SUCCESS) {
                        $('#users-data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.msg);
                    } else {
                        toastr.error(data.msg);
                    }
                }, 'json');
        })
    </script>
    <script type="text/javascript"></script>
@endsection
