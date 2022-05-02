<div class="modal fade" id="showProductModal" tabindex="-1" role="dialog" aria-labelledby="showProductModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Product detail') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="productImageCarousel" class="carousel slide mb-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        {{-- <li data-target="#productImageCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#productImageCarousel" data-slide-to="1"></li>
                        <li data-target="#productImageCarousel" data-slide-to="2"></li> --}}
                    </ol>
                    <div class="carousel-inner">
                        {{-- <div class="carousel-item active">
                            <img class="d-block img-fluid w-100" src="{{ asset('image/hotel6.png') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid w-100" src="{{ asset('image/hotel7.png') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid w-100" src="{{ asset('image/hotel8.png') }}" alt="Third slide">
                        </div> --}}
                    </div>
                    <a class="carousel-control-prev" href="#productImageCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productImageCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td scope="row" class="w-25">{{ __('Name') }}</td>
                            <td class="detail-name"></td>
                        </tr>
                        <tr>
                            <td scope="row" class="w-25">{{ __('Category') }}</td>
                            <td class="detail-category"></td>
                        </tr>
                        <tr>
                            <td scope="row" class="w-25">{{ __('Code') }}</td>
                            <td class="detail-code"></td>
                        </tr>
                        <tr>
                            <td scope="row" class="w-25">{{ __('Quantity') }}</td>
                            <td class="detail-quantity"></td>
                        </tr>
                        <tr>
                            <td scope="row" class="w-25">{{ __('Price') }}</td>
                            <td class="detail-price"></td>
                        </tr>
                        <tr>
                            <td scope="row" class="w-25">{{ __('Rating') }}</td>
                            <td class="detail-rating"></td>
                        </tr>
                        <tr>
                            <td scope="row" class="w-25">{{ __('CPU') }}</td>
                            <td class="detail-cpu"></td>
                        </tr>
                        <tr>
                            <td scope="row" class="w-25">{{ __('RAM') }}</td>
                            <td class="detail-ram"></td>
                        </tr>
                        <tr>
                            <td scope="row" class="w-25">{{ __('Description') }}</td>
                            <td class="detail-description"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href=""  class="btn btn-primary btn-edit-product">{{ __('Edit') }}</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('CLose') }}</button>
            </div>
        </div>
    </div>
</div>
