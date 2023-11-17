@extends('layouts.app')

@section('content')
    @vite('resources/css/app.css')
    <div class="container">
        <section class="bg-gray-50 min-h-screen flex items-center justify-center">
            <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl">
                <div class="sm:w-3/5 px-16">
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[150px] h-[130px] mx-auto">
                    <h1 class="font-bold text-customRed text-center text-xl">MindScape</h1>
                    <br>
                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                        @csrf
                        @if (session('status'))
                            <div id="errorMessage" class="alert alert-danger text-center">{{ 'Error Login Credentials' }}
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('errorMessage').style.display = 'none';
                                }, 5000); // Hide the message after 5 seconds
                            </script>
                            <br>
                        @endif

                        @if (session('success'))
                            <div id="successMessage" class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('successMessage').style.display = 'none';
                                }, 5000); // Hide the message after 5 seconds
                            </script>
                        @endif
                        <div class="mb-4">
                            <input id="email" type="email" class="form-control p-2 rounded-xl border w-full"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Email">
                        </div>
                        <div class="password-container relative mb-4">
                            <input id="password" type="password" class="form-control p-2 rounded-xl border w-full"
                                name="password" required autocomplete="new-password" placeholder="Password">
                            <span class="toggle-password absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer"
                                onclick="togglePassword()">
                                <img src="{{ asset('/images/show-password.png') }}" alt="Show Password" class="w-6 h-6">
                            </span>
                        </div>
                        <button class="border bg-customRed rounded-2xl w-full text-customYellow py-2"
                            type="submit">{{ __('Login') }}</button>
                        <a href="{{ url('/forget-password') }}"
                            class="text-[13px] hover:underline text-center mt-2 text-customRed block">Forgot password?</a>
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

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.querySelector(".toggle-password img");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.src = "{{ asset('/images/hide-password.png') }}";
            } else {
                passwordInput.type = "password";
                eyeIcon.src = "{{ asset('/images/show-password.png') }}";
            }
        }
    </script>
@endsection
