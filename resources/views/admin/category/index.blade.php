@extends('layouts.admin-layout')

@section('title')
    <title>{{ __('Admin') }} - {{ __('Category') }}</title>
@endsection

@section('header')
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addCategoryModal">
                {{ __('Create') }} {{ __('Category') }}
            </button>
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ __('Category List') }}</strong>
                </div>

                <div class="card-body">
                    <table id="categories-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th class="w-10">{{ __('No.') }}</th>
                                <th>{{ __('Name') }} {{ __('Category') }}</th>
                                <th class="w-25">{{ __('Updated At') }}</th>
                                <th class="w-15">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.category.add')
    @include('admin.category.edit')
@endsection

@section('script')
    <script>
        $('#main-menu ul li').removeClass('active')
        $('#main-menu ul .category').addClass('active')
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // toastr.options.preventDuplicates = true;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#categories-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.list') }}",
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
                        width: "20%",
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
            });

        });
        $(document).on('click', '#btnAdd', function() {
            var name = $('.add-name-input').val()
            $.ajax({
                url: "{{ url('admin/categories') }}",
                type: "POST",
                data: {
                    name: name
                },
                dataType: 'json',
                success: function(data) {
                    if (data.code == SUCCESS) {
                        $('#addCategoryModal').hide()
                        $('.modal-backdrop').hide()
                        $('#categories-data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.msg);
                    } else {
                        toastr.error(data.msg);

                    }
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                    // Render the errors with js ...
                }
            })
        })
        $(document).on('click', '#btnEdit', function() {
            var id = $(this).data('id')
            $('.name-error').addClass('d-none')
            $.ajax({
                url: "{{ url('admin/categories') }}" + '/' + id + '/edit',
                type: 'GET',
                success: function(data) {
                    $('.edit-name-input').val(data.category.name)
                    $('#btnUpdate').data('id', id)
                },
                error: function(data) {
                    toastr.error(data.msg);
                }
            }, 'json')
        })
        $(document).on('click', '#btnUpdate', function() {
            var id = $(this).data('id')
            var name = $('.edit-name-input').val()
            $.ajax({
                url: "{{ url('admin/categories') }}" + '/' + id,
                type: 'PUT',
                data: {
                    name: name
                },
                dataType: 'json',
                success: function(data) {
                    $('#categories-data-table').DataTable().ajax.reload(null, false);
                    console.log(data)
                    if (data.code == SUCCESS) {
                        toastr.success(data.msg);
                        $('#addCategoryModal').hide()
                        $('.modal-backdrop').hide()
                        $('.name-error').addClass('d-none')

                    } else if (data.code == INFO) {
                        toastr.info(data.msg);
                    } else {
                        $('.name-error').removeClass('d-none')
                        $('.name-error').data('id', id)
                        $('.name-error').html(data.error)
                    }
                },
                error: function(data) {
                    toastr.error(data.msg);
                    var errors = data.responseJSON;
                    $('.name-error').html(errors.errors.name[0])
                    $('.name-error').removeClass('d-none')
                }
            }, 'json')
        })
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
                        url: "{{ url('admin/categories') }}" + '/' + id,
                        type: 'DELETE',
                        success: function(data) {
                            if (data.code == SUCCESS) {
                                $('#categories-data-table').DataTable().ajax.reload(null,
                                    false);
                                toastr.success(data.msg);
                            } else {
                                toastr.error(data.msg);
                            }
                        }
                    }, 'json')
                }
            });
        })
    </script>
    <script type="text/javascript"></script>
@endsection
