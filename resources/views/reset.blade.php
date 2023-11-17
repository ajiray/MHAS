@extends('layouts.app')

@section('content')
    @vite('resources/css/app.css')
    <div class="container">
        <section class="bg-gray-50 min-h-screen flex items-center justify-center">
            <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl">
                <div class="sm:w-3/5 px-16">
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[150px] h-[130px] mx-auto">
                    <h1 class="font-bold text-customRed text-center text-xl">MindScape Reset Password</h1>
                    <br><br>
                    <div class="mt-5">
                        @if ($errors->any())
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ 'error' }}</div>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success text-center">
                                {{ 'We have successfully sent the link to your email account.' }}</div>
                        @endif
                    </div>
                    <p class="text-center">We will send a link to your email, use that link to reset your password.</p>
                    <form method="POST" action="{{ route('forget.password.post') }}">
                        @csrf

                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror ml-[5px] p-2 rounded-xl border"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                        <br>
                        <button class="border bg-customRed rounded-2xl w-1/2 ml-[60px] text-customYellow"
                            type="submit">{{ __('Send Email Link') }}</button><br>
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
