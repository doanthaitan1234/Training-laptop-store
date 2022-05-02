@extends('layouts.client-layout')

@section('content')
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @foreach (App\Helpers\Custom::getPathImagesByProductId($product->id) as $image)
                                    <div class="item-slick3" data-thumb="{{ asset($image->path) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset($image->path) }}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ asset($image->path) }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <div class="d-flex">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14 w-75">
                                {{ $product->name }}
                            </h4>
                            {{-- <div class="ms-3 me-3 icon-dots-cover">
                                <i class="fa fa-circle fa-2xs " aria-hidden="true"></i>
                            </div> --}}
                            <h4 class="mtext-105 cl2 p-b-14">
                                <div class="bg-warning ps-1 pe-1">
                                    <span class="product-rating">{{ $product->rating }}</span> <i class="zmdi zmdi-star"></i>
                                </div>
                                 
                            </h4>
                        </div>


                        <span class="mtext-106 cl2">
                            ${{ $product->price }}
                        </span>
                        <div class="cl2 d-flex">
                            <div class="your-rating-title">{{ __('Your rating') }}:</div>
                            <span class="wrap-rating fs-18 cl11 pointer your-rating-cover">
                                @for ($i = 0; $i < $rating; $i++)
                                <i class="item-rating pointer zmdi zmdi-star"></i>
                                @endfor
                                @for ($i = 5; $i > $rating; $i--)
                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                @endfor
                                <input class="dis-none" type="number" name="rating">
                                <input class="dis-none" type="hidden" name="product_id" value="{{ $product->id }}">
                            </span>
                        </div>

                        <p class="stext-102 cl3 p-t-23 mini-description">
                            {!! $product->description !!}
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product"
                                            value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                        data-id="{{ $product->id }}">
                                        {{ __('Add to cart') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">{{ __('Description') }}</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">{{ __('Additional
                                information') }}</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <ul class="p-lr-28 p-lr-15-sm">
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                {{ __('CPU') }}
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                {{ $product->cpu }}
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                {{ __('RAM') }}
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                {{ $product->ram }} {{ __('GB') }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
        $('.js-addcart-detail').on('click', function() {
            var product_name = $('.js-name-detail').text()
            var quantity = $('input[name="num-product"]').val()
            var product_id = $(this).data('id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/add-to-cart') }}",
                data: {
                    product_id: product_id,
                    quantity: quantity
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    swal(product_name, "is added to cart !", "success");
                    $('.js-show-cart').attr('data-notify', data.count)
                    var html = '';
                    data.list_cart.forEach(item => {
                        html += '<li class="header-cart-item flex-w flex-t m-b-12">' +
                            '<div class="header-cart-item-img">' +
                            '<img src="images/item-cart-01.jpg" alt="IMG">' +
                            '</div>' +
                            '<div class="header-cart-item-txt p-t-8">' +
                            '<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">' +
                            item.product.name +
                            '</a>' +
                            '<span class="header-cart-item-info">' + item.quantity +
                            ' x $' + item.product.price +
                            '</span></div></li>';
                    });
                    $('.header-cart-wrapitem').html(html);
                    $('.header-cart-total').html('Total: $' + data.total_price)
                },
                error: function() {
                    swal(product_name, "error!", "error");
                },
            })

        });
        $('.wrap-rating').each(function() {
            var item = $(this).find('.item-rating');
            var rated = -1;
            var input = $(this).find('input[name="rating"]');
            $(input).val(0);

            $(item).on('mouseenter', function() {
                var index = item.index(this);
                var i = 0;
                for (i = 0; i <= index; i++) {
                    $(item[i]).removeClass('zmdi-star-outline');
                    $(item[i]).addClass('zmdi-star');
                }

                for (var j = i; j < item.length; j++) {
                    $(item[j]).addClass('zmdi-star-outline');
                    $(item[j]).removeClass('zmdi-star');
                }
            });

            $(item).on('click', function() {
                var index = item.index(this);
                rated = index;
                $(input).val(index + 1);
                var id = $('input[name="product_id"]').val()
                var rating = $(input).val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/vote-product') }}" + '/' + id,
                    type: 'POST',
                    data: {
                        rating: rating
                    },
                    dataType: 'json',
                    success: function(data) {
                        swal('{{ __('Voting success!') }}', "", "success");
                        $('.product-rating').text(data.rating)
                    }

                })
            });

            // $(this).on('mouseleave', function() {
            //     var i = 0;
            //     for (i = 0; i <= rated; i++) {
            //         $(item[i]).removeClass('zmdi-star-outline');
            //         $(item[i]).addClass('zmdi-star');
            //     }

            //     for (var j = i; j < item.length; j++) {
            //         $(item[j]).addClass('zmdi-star-outline');
            //         $(item[j]).removeClass('zmdi-star');
            //     }
            // });
        });
    </script>
@endsection
