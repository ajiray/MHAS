@extends('layouts.app')

@section('content')
    @vite('resources/css/app.css')
    <div class="container">
        <section class="bg-gray-50 min-h-screen flex items-center justify-center">
            <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl">
                <div class="sm:w-3/5 px-16">
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[150px] h-[130px] mx-auto">
                    <h1 class="font-bold text-customRed text-center text-xl">MindScape</h1>
                    <h1 class="font-bold text-black text-center text-xl">Create your new own password</h1>

                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf
                        <input id="current_password" type="password"
                        class="form-control @error('current_password') is-invalid @enderror ml-[5px] p-2 px-2 rounded-xl border"
                            name="current_password" required autocomplete="name" autofocus
                            placeholder="Current Password">
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
                        class="form-control ml-[5px] p-2 rounded-xl border"
                        name="new_password_confirmation" required autocomplete="course" placeholder="New Password">
                        <br>
                        <button class="border bg-customRed rounded-2xl w-1/2 ml-[60px] text-customYellow"
                            type="submit">{{ __('Submit') }}</button><br>
                    </form>
                </div>
                <div
                    class="sm:block hidden bg-gradient-to-b from-customRed via-customRed to-customYellow w-[480px] h-[500px] rounded-2xl">
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[100px] h-[80px] ml-[290px]">
                    <h1 class="text-customYellow font-bold text-xl text-right -mt-[50px] mr-[90px]">Mindscape</h1>
                    <h1 class="text-center text-customYellow font-bold text-xl mt-[130px]">University of Perpetual Help
                        System Dalta Las Pinas</h1>
                    <h1 class="text-center text-customRed font-bold text-xl mt-[130px]">Mental Health Awareness System</h1>
                </div>
            </div>
        </section>

    </div>
@endsection
