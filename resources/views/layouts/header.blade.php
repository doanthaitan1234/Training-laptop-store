<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                   {{ __(' Free shipping for standard order over $100') }}
                </div>

                <div class="right-top-bar flex-w h-full">
                    @if (Route::has('login'))
                        @auth
                        <a href="{{ route('myProfile') }}" class="flex-c-m trans-04 p-lr-25">
                            {{ __('My Account') }}
                        </a>
                        <a class="flex-c-m trans-04 p-lr-25" href="" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" {{ __('Logout') }}>{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                        
                        @else
                            <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">{{ __('Login') }}</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="flex-c-m trans-04 p-lr-25">{{ __('Register') }}</a>
                            @endif
                        @endauth
                    @endif
                    @if (Session::get('website_language') == 'vi')
                        <a href="{{ route('lang', ['en']) }}" class="flex-c-m trans-04 p-lr-25">
                            {{ __('EN') }}
                        </a>
                    @else
                        <a href="{{ route('lang', ['vi']) }}" class="flex-c-m trans-04 p-lr-25">
                            {{ __('VI') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <img src="{{ asset('image/logo.jfif') }}" alt="LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="shop" data-label1="hot">
                            <a href="{{ route('product') }}">{{ __('Shop') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    {{-- <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div> --}}

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                        data-notify="{{ App\Helpers\Custom::getcountCart() }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="{{ asset('image/logo.jfif') }}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="0">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Help & FAQs
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        USD
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="index.html">Home</a>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li>
                <a href="product.html">Shop</a>
            </li>

            <li>
                <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
            </li>

            <li>
                <a href="blog.html">Blog</a>
            </li>

            <li>
                <a href="about.html">About</a>
            </li>

            <li>
                <a href="contact.html">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('bower_components/laptop-store-template/images/icons/icon-close2.png') }}"
                    alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>

<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                {{ __('Your Cart') }}
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @if (App\Helpers\Custom::getCartList() != '')
                    @foreach (App\Helpers\Custom::getCartList() as $cart_item)
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="{{ asset(App\Helpers\Custom::getPathImageByProductId($cart_item['product_id'])) }}" alt="IMG">
                        </div>
    
                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                {{ $cart_item['product']['name'] }}
                            </a>
    
                            <span class="header-cart-item-info">
                                {{ $cart_item['quantity'] }} x ${{ $cart_item['product']['price'] }}
                            </span>
                        </div>
                    </li>
                    @endforeach
                @endif
            </ul>
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40 font-weight-bold">
                    {{ __('Total') }}: ${{ App\Helpers\Custom::getTotalPriceCart() }}
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="{{ route('cart.show') }}"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        {{ __('View Cart') }}
                    </a>

                    <a href="shoping-cart.html"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        {{ __('Check Out') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
