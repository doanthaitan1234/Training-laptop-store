@extends('layouts.admin-layout')

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ __('Order') }}: {{ $order->code }}</h1>
                            <input type="hidden" class="order-id" value="{{ $order->id }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-center text-white bg-info">
                            <strong class="card-title">{{ __('Customer Info') }}</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('Address') }}</th>
                                        <th scope="col">{{ __('Phone') }}</th>
                                        <th scope="col">{{ __('Note') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->user->phone }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-center text-white bg-info">
                            <strong class="card-title">{{ __('Order Info') }}</strong>
                        </div>
                        <div class="card-body">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('Product Name') }}</th>
                                        <th scope="col">{{ __('Image') }}</th>
                                        <th scope="col">{{ __('Price') }}</th>
                                        <th scope="col">{{ __('Quantity') }}</th>
                                        <th scope="col">{{ __('Quantity In Stock') }}</th>
                                        <th scope="col">{{ __('Total Price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($order_products as $item)
                                        <tr>
                                            <th scope="row">{{ $index++ }}</th>
                                            <td>{{ $item->product->name }}</td>
                                            <td><img src="{{ asset(App\Helpers\Custom::getPathImageByProductId($item->product_id)) }}"
                                                    alt="" width="60px" height="50px"></td>
                                            <td>${{ $item->price }}</td>
                                            <td>
                                                @if ($order->status == App\Defines\Define::WAITING)
                                                    <span><input type="text" class="w-25 quantity-input"
                                                            id="quantity-{{ $item->id }}"
                                                            value="{{ $item->quantity }}"></span>
                                                    <button class="btn btn-info btn-update-quantity" type="button"
                                                        data-id="{{ $item->id }}">{{ __('Update') }}</button>
                                                @else
                                                    {{ $item->quantity }}
                                                @endif

                                            </td>
                                            <td>{{ $item->product->quantity }}</td>
                                            <td>${{ $item->quantity * $item->price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <div class="text-right"><b>{{ __('Total: ') }}</b>${{ $order->total_price }}</div>
                        </div>
                    </div>

                    @if ($order->status == App\Defines\Define::WAITING)
                        <div class="text-right">
                            <a href="{{ route('orders.confirm', $order->id) }}"
                                class="btn btn-primary me-3 btn-confirm">{{ __('Confirm Order ') }}</a>
                            <a type="button" class="btn btn-danger">{{ __('Cancel Order') }}</a>
                        </div>
                    @else
                        <div>
                            <h4 class="mb-2">{{ __('Change status') }}</h4>
                            <select data-placeholder="{{ __('Choose a status...') }}" class="select-status-order w-100"
                                tabindex="1">
                                @foreach (App\Helpers\Custom::getAllStatusOrder() as $status)
                                    @if ($status['value'] != App\Defines\Define::WAITING)
                                        <option value="{{ $status['value'] }}"
                                            @if ($order->status == $status['value']) selected @endif>{{ $status['content'] }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @endif

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
    <script>
        $(document).ready(function() {
            $('.select-status-order').select2()
            $('.btn-update-quantity').on('click', function() {
                var id = $(this).data('id')
                var quantity_change = $('#quantity-' + id).val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('admin/update-order-quantity') }}",
                    type: 'PATCH',
                    data: {
                        id: id,
                        quantity_change: quantity_change
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                    },
                    error: function(data) {
                        console.log(data)
                    }

                })
            })
            $('.select-status-order').on('change', function() {
                var id = $('.order-id').val()
                var status = $(this).val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('admin/update-order-status') }}",
                    type: 'patch',
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: 'json',
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(data) {
                        toastr.error(data.message)
                    }

                })
            })
        })
    </script>
@endsection
