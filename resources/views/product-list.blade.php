@foreach ($products as $product)
    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
        <div class="block2">
            <div class="block2-pic hov-img0">
                <img src=" {{ asset(App\Helpers\Custom::getPathImageByProductId($product->id)) }}" alt="" class="product-image"
                    height="200px">

                <a href="#"
                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                    data-id="{{ $product->id }}">
                    {{ __('Quick View') }}
                </a>
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l w-75">
                    <a href="{{ route('product.detail', $product->id) }}"
                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        {{ $product->name }}
                    </a>

                    <span class="stext-105 cl3">
                        ${{ $product->price }}
                    </span>
                </div>
                <div class="block2-txt-child2 flex-r p-t-3 w-25">
                    {{ $product->rating }}
                    <div class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                        <i class="zmdi zmdi-star"></i>
                    </div>
                    {{-- <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                        <i class="zmdi zmdi-star"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
@endforeach
