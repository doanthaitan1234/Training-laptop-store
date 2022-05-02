@extends('layouts.client-layout')


@section('content')
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 filter-category how-active1 filter-category-active" data-id="-1">
                        {{ __(' All Products') }}
                    </button>

                    @foreach ($categories as $category)
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 filter-category"
                             data-id="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filter
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
                            placeholder="Search">
                    </div>
                </div>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                {{ __('Sort By') }}
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-sort-by filter-link-active">
                                        {{ __('Default') }}
                                    </a>
                                </li>
                                
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Price
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-price filter-link-active filter-price-active" data-min="-1" data-max="-1">
                                        All
                                    </a>
                                </li>
                                @foreach (App\Helpers\Custom::getFilterPrice() as $filter_price)
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-price" data-min="{{ $filter_price['min'] }}" data-max="{{ $filter_price['max'] }}">
                                        {{ $filter_price['content'] }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="filter-col3 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                {{ __('RAM') }}
                            </div>
                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-ram filter-link-active filter-ram-active" data-ram="-1">
                                        {{ __('All') }}
                                    </a>
                                </li>
                                @foreach (App\Helpers\Custom::getFilterRam() as $ram)
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-ram" data-ram="{{ $ram }}">
                                       {{ $ram }}{{ __('GB') }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="filter-col4 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                {{ __('Rating') }}
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-rating filter-link-active filter-rating-active" data-min="-1" data-max="-1">
                                        {{ __('All') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="filter-link stext-106 trans-04 filter-rating" data-min="4" data-max="5">
                                        4 - 5 <i class="zmdi zmdi-star"></i>
                                     </a>
                                </li>
                                <li>
                                    <a href="#" class="filter-link stext-106 trans-04 filter-rating" data-min="3" data-max="4">
                                        3 - 4 <i class="zmdi zmdi-star"></i>
                                     </a>
                                </li>
                                <li>
                                    <a href="#" class="filter-link stext-106 trans-04 filter-rating" data-min="2" data-max="3">
                                        2 - 3 <i class="zmdi zmdi-star"></i>
                                     </a>
                                </li>
                                <li>
                                    <a href="#" class="filter-link stext-106 trans-04 filter-rating" data-min="1" data-max="2">
                                        1 - 2 <i class="zmdi zmdi-star"></i>
                                     </a>
                                </li>
                                <li>
                                    <a href="#" class="filter-link stext-106 trans-04 filter-rating" data-min="0" data-max="1">
                                        0 - 1 <i class="zmdi zmdi-star"></i>
                                     </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row isotope-grid">
            </div>
            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Load More
                </a>
            </div>
        </div>
    </div>
    

    <!-- Modal1 -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="{{ asset('bower_components/laptop-store-template/images/icons/icon-close.png') }}"
                        alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14 name-detail"></h4>
                            <span class="mtext-106 cl2 price-detail"></span>
                            <p class="stext-102 cl3 p-t-23 description-detail"></p>
                            <p class="stext-102 cl3 p-t-23 cpu-detail"></p>
                            <p class="stext-102 cl3 p-t-23 ram-detail"></p>
                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <button
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            {{ __('Add to cart') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!--  -->
                            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                <div class="flex-m bor9 p-r-10 m-r-11">
                                    <a href="#"
                                        class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                        data-tooltip="Add to Wishlist">
                                        <i class="zmdi zmdi-favorite"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })

        /*---------------------------------------------*/
        
        function getProductsAjax()
        {
            var min_price = $('.filter-price-active').data('min')
            var max_price = $('.filter-price-active').data('max')
            var min_rating = $('.filter-rating-active').data('min')
            var max_rating = $('.filter-rating-active').data('max')
            var ram = $('.filter-ram-active').data('ram')
            console.log(ram)
            var category_id = $('.filter-category-active').data('id')
            var search_product = $.trim($('input[name="search-product"]').val())
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{ url('/get-products') }}",
                data: {
                    min_price: min_price,
                    max_price: max_price,
                    min_rating: min_rating,
                    max_rating: max_rating,
                    ram: ram,
                    category_id: category_id,
                    search_product: search_product
                },
                dataType: 'json',
                success: function(data) {
                    if (data.html == '') {
                        $('.isotope-grid').html('<h4 class="text-center">{{ __("No products was found") }}</h4>')
                    } else {
                        $('.isotope-grid').html(data.html)
                    }
                },
                error: function() {
                },
            })

        }
        $(document).ready(function() {
            getProductsAjax()
        })
        $('.filter-price').on('click', function() {
            $('.filter-price').removeClass('filter-link-active')
            $(this).addClass('filter-link-active')
            $('.filter-price').removeClass('filter-price-active')
            $(this).addClass('filter-price-active')
            getProductsAjax()
            
        })
        $('.filter-ram').on('click', function() {
            $('.filter-ram').removeClass('filter-link-active')
            $(this).addClass('filter-link-active')
            $('.filter-ram').removeClass('filter-ram-active')
            $(this).addClass('filter-ram-active')
            getProductsAjax()
        })
        $('.filter-rating').on('click', function() {
            $('.filter-rating').removeClass('filter-link-active')
            $(this).addClass('filter-link-active')
            $('.filter-rating').removeClass('filter-rating-active')
            $(this).addClass('filter-rating-active')
            getProductsAjax()
        })
        $('.filter-category').on('click', function() {
            $('.filter-category').removeClass('filter-category-active')
            $(this).addClass('filter-category-active')
            $('.filter-category').removeClass('filter-ram-active')
            getProductsAjax()
        })

        $('input[name="search-product"]').on('keyup', function() {
            getProductsAjax()
        })

        /*---------------------------------------------*/


        /*---------------------------------------------*/

        $('.js-show-modal1').on('click', function(e) {
            var id = $(this).data('id');
            var asset = "{{ asset('') }}";
            e.preventDefault();
            $('.js-modal1').addClass('show-modal1');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{ url('/get-product-images-ajax') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var asset = '{{ asset('') }}';
                    data.product.images.forEach(image => {
                        // console.log(asset + image.path)
                        html += '<div class="item-slick3" data-thumb="' + asset + image.path +
                            '"><div class="wrap-pic-w pos-relative"><img src="' + asset + image.path +
                            '" alt="IMG-PRODUCT"><a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"href="' +
                            asset + image.path +
                            '"><i class="fa fa-expand"></i></a></div></div>'
                    });
                    $('.slick3').html(html);
                    $('.name-detail').html(data.product.name)
                    $('.price-detail').html('$' + data.product.price)
                    $('.description-detail').html(data.product.description)
                    $('.cpu-detail').html('CPU: ' + data.product.cpu)
                    $('.ram-detail').html('RAM: ' + data.product.ram + 'GB')
                    $('.js-addcart-detail').data('productid', data.product.id)
                },
                error: function() {
                },
            })
        });

        $('.js-hide-modal1').on('click', function() {
            $('.js-modal1').removeClass('show-modal1');
        });

        /*---------------------------------------------*/

        $('.js-addwish-b2, .js-addwish-detail').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        $('.js-addcart-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
            var id = '{{ Auth::id() }}'

            $(this).on('click', function() {
                var quantity = $('input[name="num-product"]').val()
                var product_id = $(this).data('productid')
                if (id == '') {
                    swal(nameProduct, "Login first, please!", "warning");
                } else {
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
                            swal(nameProduct, "is added to cart !", "success");
                            $('.js-show-cart').attr('data-notify', data.count)
                            var html ='';
                            data.list_cart.forEach(item => {
                                html += '<li class="header-cart-item flex-w flex-t m-b-12">' +
                                            '<div class="header-cart-item-img">' +
                                                '<img src="images/item-cart-01.jpg" alt="IMG">' +
                                            '</div>' +
                                            '<div class="header-cart-item-txt p-t-8">' +
                                                '<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">' + item.product.name +
                                                '</a>' +
                                                '<span class="header-cart-item-info">' + item.quantity + ' x $' + item.product.price +
                                                '</span></div></li>';
                            });
                            $('.header-cart-wrapitem').html(html);
                            $('.header-cart-total').html('Total: $' + data.total_price)
                        },
                        error: function() {
                            swal(nameProduct, "error!", "error");
                        },
                    })
                }
            });
        });
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });

        /*---------------------------------------------*/

        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
        })
    </script>
@endsection
