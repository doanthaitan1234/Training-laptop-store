@extends('layouts.admin-layout')

@section('title')
    <title>{{ __('Admin') }} - {{ __('Order') }}</title>
@endsection

@section('header')
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ __('Order List') }}</strong>
                </div>


                <div class="card-body">
                    <div class="select-cover">
                        <select data-placeholder="{{ __('Choose a status...') }}" class="select-status-order w-100"
                            tabindex="1">
                            <option value="" label="default"></option>
                            @foreach (App\Helpers\Custom::getAllStatusOrder() as $status)
                                <option value="{{ $status['value'] }}">{{ $status['content'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <table id="orders-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __('No.') }}</th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Customer') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Total Price') }}</th>
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
        $('#main-menu ul .order').addClass('active')
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select-status-order').select2()

            // $('.carousel').carousel()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var orders_table = $('#orders-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('orders.list') }}",
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
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'code',
                        name: 'code',
                    },
                    {
                        data: 'user',
                        name: 'user',
                    },
                    {
                        data: 'address',
                        name: 'address',
                    },
                    {
                        data: 'total_price',
                        name: 'total_price',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
            });
            $('.select-status-order').on('change', function() {
                orders_table.columns(5).search($(this).val()).draw();
                // if ($(this).val() != -1) {
                // } else {
                //     orders_table.draw();
                // }
            });
        });

        $(document).on('change', '.select-status-order', function() {
            $('#orders-data-table').DataTable()
        })
        $(document).on('click', '#btnCancel', function() {
            var id = $(this).data('id')
            swal.fire({
                title: '{{ __('Are you sure?') }}',
                html: '{{ __('You want to cancel this order') }}',
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, Cancel Order',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',
                width: 300,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'patch',
                        url: "{{ url('admin/cancel-order') }}" + '/' + id,
                        success: function(data) {
                            $('#orders-data-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.message);
                        },
                        error: function(data) {
                            toastr.error(data.message);
                        }
                    }, 'json')
                }
            });
        })
    </script>
    <script type="text/javascript"></script>
@endsection
