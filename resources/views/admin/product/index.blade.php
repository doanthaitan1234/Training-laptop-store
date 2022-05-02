@extends('layouts.admin-layout')

@section('title')
    <title>{{ __('Admin') }} - {{ __('Product') }}</title>
@endsection

@section('header')
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">{{ __('Create') }}
                {{ __('Product') }}</a>
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ __('Product List') }}</strong>
                </div>

                <div class="card-body">
                    <table id="products-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __('No.') }}</th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Name') }} {{ __('Product') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.product.show')
@endsection

@section('script')
    <script>
        $('#main-menu ul li').removeClass('active')
        $('#main-menu ul .product').addClass('active')
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.carousel').carousel()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#products-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.list') }}",
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
                        data: 'category.name',
                        name: 'category',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
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
                html: '{{ __('You want to delete this product') }}',
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
                        url: "{{ url('admin/products') }}" + '/' + id,
                        success: function(data) {
                            if (data.code == SUCCESS) {
                                $('#products-data-table').DataTable().ajax.reload(null, false);
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
            var url = '{{ route('products.changeStatus') }}';
            $.post(url, {
                    id: id
                },
                function(data) {
                    if (data.code == SUCCESS) {
                        $('#products-data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.msg);
                    } else {
                        toastr.error(data.msg);
                    }
                }, 'json');
        })
        $(document).on('click', '#btnShow', function() {
            var id = $(this).data('id')
            var url = '{{ route('products.getOne') }}';
            $.get(url, {
                    id: id
                },
                function(data) {
                    if (data.code == 0) {
                        toastr.error(data.msg);
                    } else {
                        console.log(data);
                        var index = 0;
                        var html = '';
                        var indicators = '';
                        var inner = '';
                        var asset = '{{ asset('') }}'
                        var route = "{{ url('admin/products') }}" + '/' + id + '/edit'
                        data.product.images.forEach(image => {
                            indicators += '<li data-target="#productImageCarousel" data-slide-to="' +
                                index + '" class="active"></li>';
                            inner +=
                                '<div class="carousel-item"> <img class="d-block img-fluid w-100" src="' +
                                asset + image.path + '" alt="Second slide"></div>';
                            index++;
                        });
                        $('.carousel-indicators').html(indicators)
                        $('.carousel-indicators li:first-child').addClass('active')
                        $('.carousel-inner').html(inner)
                        $('.carousel-inner .carousel-item:first-child').addClass('active')

                        $('.detail-name').html(data.product.name)
                        $('.detail-category').html(data.product.category.name)
                        $('.detail-code').html(data.product.code)
                        $('.detail-quantity').html(data.product.quantity)
                        $('.detail-price').html('$' + data.product.price)
                        $('.detail-rating').html(data.product.rating + ' (' + data.count_rating + ' votes)')
                        $('.detail-cpu').html(data.product.cpu)
                        $('.detail-ram').html(data.product.ram + 'GB')
                        $('.detail-description').html(data.product.description)
                        $('.btn-edit-product').attr('href', route)

                    }
                }, 'json');
        })
    </script>
    <script type="text/javascript"></script>
@endsection
