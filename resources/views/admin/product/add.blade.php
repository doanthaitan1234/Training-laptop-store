@extends('layouts.admin-layout')

@section('title')
    <title>
        {{ __('Admin') }} -{{ __('Create') }} {{ __('Product') }}</title>
@endsection

@section('header')
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>{{ __('Create') }} {{ __('Product') }}</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 border-right pr-2">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="category"
                                        class=" form-control-label">{{ __('Category') }}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="js-example-basic-single w-100 form-control" name="category_id">
                                        <option value="">---{{ __('Select Category') }}---</option>
                                        @foreach (App\Helpers\Custom::getCategories() as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('category_id') == $category->id) selected @endif>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="name"
                                        class=" form-control-label">{{ __('Name') }}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="name" value="{{ old('code') }}" class="form-control">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="code"
                                        class=" form-control-label">{{ __('Code') }}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="code" value="{{ old('code') }}" class="form-control">
                                    @error('code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="quantity" class=" form-control-label">{{ __('Quantity') }}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="quantity" value="{{ old('quantity') }}"
                                        class="form-control">
                                    @error('quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="price" class=" form-control-label">{{ __('Price') }}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="price" value="{{ old('price') }}" class="form-control">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="cpu" class=" form-control-label">{{ __('CPU') }}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="cpu" value="{{ old('cpu') }}" class="form-control">
                                    @error('cpu')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="ram" class=" form-control-label">{{ __('RAM') }}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="ram" value="{{ old('ram') }}" class="form-control">
                                    @error('ram')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="description" class=" form-control-label">{{ __('Description') }}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="description" id="textarea-input" rows="5"
                                        class="ckeditor form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-1"></div> --}}
                        <div class="col-lg-6">

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="image" class=" form-control-label">{{ __('Image') }}</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="files-input" name="image[]" multiple=""
                                            class="form-control-file">
                                    </div>
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 row mt-3 image-list"></div>
                            </div>
                            <hr>
                            <div class="d-flex flex-row-reverse action-group">
                                <button type="reset" class="btn btn-danger btn-sm btn-reset">
                                    {{ __('Reset') }}
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm mr-3 btn-add">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $('#main-menu ul li').removeClass('active')
        $('#main-menu ul .product').addClass('active')
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            if (window.File && window.FileList && window.FileReader) {
                $("#files-input").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"image-cover col-4\">" +
                                "<img class=\"image-thumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<span class=\"remove\"><i class=\"fa fa-times-circle icon-remove\" aria-hidden=\"true\"></i></span>" +
                                "</span>").insertAfter(".image-list");
                            $(".remove").click(function() {
                                $(this).parent(".image-cover").remove();
                            });

                            // Old code here
                            /*$("<img></img>", {
                              class: "imageThumb",
                              src: e.target.result,
                              title: file.name + " | Click to remove"
                            }).insertAfter("#files").click(function(){$(this).remove();});*/

                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script>
@endsection
