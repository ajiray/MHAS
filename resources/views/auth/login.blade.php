@extends('layouts.app')

@section('content')
    @vite('resources/css/app.css')
    <div class="container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <section class="bg-gray-50 min-h-screen flex items-center justify-center">
                <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl">
                    <div class="sm:w-1/2 px-16">
                        <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[150px] h-[130px] mx-auto">
                        <h1 class="font-bold text-maroon text-center text-xl">MindScape</h1>

                        <form class="flex flex-col gap-4">
                            <input
                                class="p-2 mt-8 rounded-xl border ml-[20px] form-control @error('email') is-invalid @enderror"
                                id="email" type="email" name="email" value="{{ old('email') }}" required
                                autocomplete="email" autofocus placeholder="Username">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br><br>
                            <input
                                class="p-2 rounded-xl border ml-[20px] form-control @error('password') is-invalid @enderror"
                                id="password" type="password" name="password" required autocomplete="current-password"
                                placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br><br>
                            <button class="border bg-maroon rounded-2xl w-1/2 ml-[60px] text-yellow"
                                type="submit">{{ __('Login') }}</button><br>
                            <a href="#" class="text-[13px] hover:underline text-center ml-[70px] text-maroon">Forgot
                                password?</a><br><br>
                        </form>
                    </div>
                    <div
                        class="sm:block hidden bg-gradient-to-b from-maroon via-maroon to-yellow w-[400px] h-[500px] rounded-2xl p-1">
                        <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[100px] h-[80px] ml-[290px]">
                        <h1 class="text-yellow font-bold text-xl text-right -mt-[50px] mr-[90px]">Mindscape</h1>
                        <h1 class="text-center text-yellow font-bold text-xl mt-[130px]">University of Perpetual Help
                            System Dalta Las Pinas</h1>
                        <h1 class="text-center text-maroon font-bold text-xl mt-[130px]">Mental Health Awareness System
                        </h1>
                    </div>
                </div>
            </section>

    </div>
@endsection
