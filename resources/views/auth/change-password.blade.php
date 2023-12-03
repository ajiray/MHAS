@extends('layouts.app')

@section('content')
    @vite('resources/css/app.css')
    <div class="container">
        <section class="bg-gray-50 min-h-screen flex items-center justify-center">
            <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl">
                <div class="sm:w-3/5 px-16">
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[150px] h-[130px] mx-auto">
                    <h1 class="font-bold text-maroon text-center text-xl">MindScape</h1>
                    <h1 class="font-bold text-black text-center text-xl">Create your new own password</h1>

                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf
                        <input id="current_password" type="password"
                            class="form-control @error('current_password') is-invalid @enderror ml-[5px] p-2 px-2 rounded-xl border"
                            name="current_password" required autocomplete="name" autofocus placeholder="Current Password">
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <input id="new_password" type="password"
                            class="form-control @error('new_password') is-invalid @enderror ml-[5px] p-2 rounded-xl border"
                            name="new_password" required autocomplete="email" placeholder="New Password">
                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <input id="new_password_confirmation" type="password"
                            class="form-control ml-[5px] p-2 rounded-xl border" name="new_password_confirmation" required
                            autocomplete="course" placeholder="Confirm New Password">
                        <br>
                        <button class="border bg-maroon rounded-full w-full p-2 text-white hover:bg-red-800"
                            type="submit">{{ __('Submit') }}</button><br>
                    </form>
                </div>
                <div
                    class="sm:block hidden bg-gradient-to-b from-maroon via-maroon to-yellow w-[480px] h-[500px] rounded-2xl">
                    <div class="mt-10 text-center flex items-center justify-center">
                        <span class="text-white text-4xl font-bold" style="text-shadow: 0 0 10px #ffffff;">Mind</span>
                        <span class="text-yellow text-4xl font-bold" style="text-shadow: 0 0 10px #ecb222;">Scape</span>
                    </div>
                    <h1 class="text-center text-yellow font-bold text-xl mt-[130px]">University of Perpetual Help
                        System Dalta Las Pinas</h1>
                    <h1 class="text-center text-maroon font-bold text-xl mt-[130px]">Mental Health Awareness System</h1>
                </div>
            </div>
        </section>

    </div>
@endsection
