@extends('layouts.client-layout')

@section('content')
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <div class="flex-w w-full p-b-42">
                    <div class="size-212 p-t-2">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            {{ __('My Profile') }}
                        </h4>
                        <div class="flex-w w-full p-b-42 ">
                            <div class="size-212 p-t-2 row">
                                <div class="mtext-110 cl2 col-3">
                                    {{ __('Name') }}
                                </div>
                                <div class="mtext-110 cl2 col-1">:</div>

                                <div class="mtext-110 cl2 col-7">
                                    {{ $customer->name }}
                                </div>
                            </div>
                            <div class="size-212 p-t-2 row">
                                <div class="mtext-110 cl2 col-3">
                                    {{ __('Email') }}
                                </div>
                                <div class="mtext-110 cl2 col-1">:</div>

                                <div class="mtext-110 cl2 col-7">
                                    {{ $customer->email }}
                                </div>
                            </div>
                            <div class="size-212 p-t-2 row">
                                <div class="mtext-110 cl2 col-3">
                                    {{ __('Phone') }}
                                </div>
                                <div class="mtext-110 cl2 col-1">:</div>

                                <div class="mtext-110 cl2 col-7">
                                    {{ $customer->phone }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <form method="POST" action="{{ route('changePassword') }}" >
                    {{ csrf_field() }}
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        {{ __('Change password') }}
                    </h4>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="current_password"
                            placeholder="{{ __('Current password') }}">
                        @error('current_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password"
                            placeholder="{{ __('New password') }}">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="bor8 m-b-30">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password"
                            name="password_confirmation" placeholder="{{ __('Confirm password') }}">
                            @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        {{ __('Change') }}
                    </button>
                </form>
            </div>

            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                {{-- <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Address
                        </span>

                        <p class="stext-115 cl6 size-213 p-t-18">
                            Coza Store Center 8th floor, 379 Hudson St, New York, NY 10018 US
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Lets Talk
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            +1 800 1236879
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Sale Support
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            contact@example.com
                        </p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
