@extends('layouts.admin-layout')

@section('title')
    <title>
        {{ __('Admin') }} -{{ __('Create') }} {{ __('User') }}</title>
@endsection

@section('header')
@endsection

@section('content')
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <strong>{{ __('Create') }} {{ __('User') }}</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="name" class=" form-control-label">{{ __('Name') }}</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="name"
                                value="{{ old('name') }}" class="form-control">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="email"
                                class=" form-control-label">{{ __('Email') }}</label></div>
                        <div class="col-12 col-md-9"><input type="email" id="email-input" name="email"
                                value="{{ old('email') }}" class="form-control">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="password"
                                class=" form-control-label">{{ __('Password') }}</label></div>
                        <div class="col-12 col-md-9"><input type="password" id="password-input" name="password"
                                class="form-control">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="phone"
                                class=" form-control-label">{{ __('Phone') }}</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="phone"
                                value="{{ old('phone') }}" class="form-control">
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="select"
                                class=" form-control-label">{{ __('Role') }}</label></div>
                        <div class="col-12 col-md-9">
                            <select name="role_id" id="select" class="form-control">
                                @foreach (App\Helpers\Custom::getRoles() as $role)
                                    <option value="{{ $role->id }}" @if ($role->id == App\Defines\Define::ADMIN) selected @endif>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button type="reset" class="btn btn-danger btn-sm ">
                            {{ __('Reset') }}
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm mr-3">
                            {{ __('Add') }}
                        </button>

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
        $('#main-menu ul .user').addClass('active')
    </script>
@endsection
